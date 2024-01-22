<?php
namespace App\Services;

use Carbon\Carbon;
use App\Models\Dosen;
use Illuminate\Support\Str;
use App\Models\PublikasiDosen;
use App\Models\AnggotaPublikasiDosen;
use Illuminate\Support\Facades\Crypt;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class GoogleScholarSyncService
{
    public function syncDosen($dosenId)
    {
        // Ambil data dosen dari database
        $dosen = Dosen::where('id', $dosenId)->first();

        if (!$dosen) {
            // Handle jika dosen tidak ditemukan
            return response()->json([
                'message' => 'Dosen tidak ditemukan',
            ], 404);
        }

        // Lakukan scraping Google Scholar untuk mendapatkan data terbaru
        $googleScholarData = $this->scrapeGoogleScholar($dosen->id);

        if (!$googleScholarData) {
            // Handle jika data dari Google Scholar tidak ditemukan
            return response()->json([
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        // Proses data dari Google Scholar
        $publikasiData = $googleScholarData->original['publications'];

        // Lakukan pengecekan dan pembaruan untuk setiap publikasi
        foreach ($publikasiData as $publikasi) {
            $i=0;
            $url = Str::limit($googleScholarData->original['publications'][$i]['url'], 500);
            $i++;

            $existingPublikasi = PublikasiDosen::where('judul', $publikasi['judul'])->first();
            
            if ($existingPublikasi) {
                $isAnggotaPublikasi = AnggotaPublikasiDosen::where('id_publikasi', $existingPublikasi->id)->where('id_dosen', $dosen->id)->first();
                if (!$isAnggotaPublikasi) {
                    // Tambahkan sebagai anggota publikasi
                    AnggotaPublikasiDosen::create([
                        'id_publikasi' => $existingPublikasi->id,
                        'id_dosen' => $dosen->id,
                        'peran' => 'Anggota', // Ketua pertama kali
                    ]);
                }
                // Jika publikasi sudah ada, perbarui jumlah kutipan
                $existingPublikasi->jumlah_kutipan = $publikasi['jumlah_kutipan'];
                $existingPublikasi->save();
            } else {
                // Jika publikasi belum ada, tambahkan publikasi baru
                $newPublikasi = [
                    'judul' => $publikasi['judul'],
                    'jumlah_kutipan' => $publikasi['jumlah_kutipan'],
                    'tahun' => $publikasi['tahun'],
                    'url' => $url,
                    'anggota_external' => $publikasi['anggota_external'],
                    'nama_publikasi' => $publikasi['nama_publikasi'],
                    'scala' => $publikasi['scala'],
                    'kategori' => $publikasi['kategori'],
                    'kategori_litabmas' => $publikasi['kategori_litabmas'],
                ];
                $newPublikasi = PublikasiDosen::create($newPublikasi);
                $id = $newPublikasi->id;
                $newUrl = "https://". $url;
                $update = PublikasiDosen::find($id)->update([
                    'encrypt_id' => Crypt::encrypt($id),
                    'url' => $newUrl,

                ]);


                // Tambahkan sebagai anggota publikasi
                AnggotaPublikasiDosen::create([
                    'id_publikasi' => $newPublikasi->id,
                    'id_dosen' => $dosen->id,
                    'peran' => 'Ketua', // Ketua pertama kali
                ]);
            }
        }
    }
    public function scrapeGoogleScholar($userId)
    {
        $cstart = 0;
        $pagesize = 80;
        $dosenUrl = Dosen::where('id', $userId)->first();
        $baseUrl = $dosenUrl->url_google_scholar;

        // Use Guzzle HTTP client to fetch the web page content
        $client = new Client();

        // Variables to store profile information
        $name = null;
        $affiliation = null;
        $publications = [];

        do {
            $url = $baseUrl . "&cstart=" . $cstart . "&pagesize=" . $pagesize;
            $response = $client->get($url);
            $html = $response->getBody()->getContents();

            // Create a new Crawler instance and load the HTML content
            $crawler = new Crawler($html);

            // Extract profile information on the first page only
            if ($cstart === 0) {
                $nameNode = $crawler->filter('#gsc_prf_in');
                $name = $nameNode->count() > 0 ? $nameNode->text() : null;

                $affiliationNode = $crawler->filter('.gsc_prf_il');
                $affiliation = $affiliationNode->count() > 0 ? $affiliationNode->text() : null;
            }

            // Extract publications on each page
            $pagePublications = $this->extractPublications($crawler);
            $publications = array_merge($publications, $pagePublications);

            // Check if the title or journal name is not found
            if (!$this->isDataFound($pagePublications)) {
                break;
            }

            // Move to the next page
            $cstart += $pagesize;

            // Sleep for a short time to avoid hitting the server too frequently
            sleep(30);
        } while (count($pagePublications) > 0);

        // Filter out publications with null values
        $publications = array_filter($publications, function ($publication) {
            return $publication['judul'] !== null && $publication['nama_publikasi'] !== null && $publication['nama_publikasi'] !== ' ' ;
        });

        // Sort publications by year, placing non-numeric years at the end
        usort($publications, function ($a, $b) {
            $yearA = is_numeric($a['tahun']) ? $a['tahun'] : PHP_INT_MAX;
            $yearB = is_numeric($b['tahun']) ? $b['tahun'] : PHP_INT_MAX;

            return $yearA - $yearB;
        });

        return response()->json([
            'name' => $name,
            'affiliation' => $affiliation,
            'publications' => $publications,
            'base_url' => $baseUrl,
        ]);
    }
    private function extractPublications(Crawler $crawler)
    {
        $publications = $crawler->filter('.gsc_a_tr')->each(function (Crawler $node) {
            $titleNode = $node->filter('.gsc_a_at');
            $title = $titleNode->count() > 0 ? $titleNode->text() : null;

            $urlNode = $node->filter('.gsc_a_at');
            $url = $urlNode->count() > 0 ? $urlNode->attr('href') : null;

            $authorsNode = $node->filter('.gs_gray')->eq(0);
            $authors = $authorsNode->count() > 0 ? $authorsNode->text() : null;

            $journalNode = $node->filter('.gs_gray')->eq(1);
            $journal = $journalNode->count() > 0 ? $journalNode->text() : 'null';
            $journalFormat = $this->formatJournal($journal);

            $citationsNode = $node->filter('.gsc_a_ac');
            $citations = $citationsNode->count() > 0 ? $citationsNode->text() : null;
            if ($citations == null || $citations == "") {
                $citations = '0';
            }

            $yearNode = $node->filter('.gsc_a_h');
            $year = $yearNode->count() > 0 ? $yearNode->text() : 0;

            if ($year != 0) {
                return [

                    'judul' => $title,
                    'url' => "https://"."scholar.google.com" . $url,
                    'anggota_external' => $authors,
                    'nama_publikasi' => $journalFormat == null ? ' ' : $journalFormat,
                    'jumlah_kutipan' => $citations,
                    'tahun' => $year,
                    'scala' => 'Nasional',
                    'kategori' => 'Jurnal Ilmiah',
                    'kategori_litabmas' => 'Penelitian'
                    // Add other data fields here
                ];
            }
        });

        // Hapus elemen yang null
        return array_filter($publications);
    }

    private function isDataFound(array $publications): bool
    {
        return count($publications) > 0;
    }

    private function formatJournal($journal)
    {
        // Hapus angka dan kurung
        $journal = preg_replace("/[0-9\(\)]/", "", $journal);

        // Hapus spasi dan koma di akhir string
        $journal = rtrim($journal, " ,");

        // Hapus angka dan kurung di awal string
        $journal = preg_replace("/^[0-9\(\)]+/", "", $journal);

        // Hapus spasi dan koma di awal string
        $journal = ltrim($journal, " ,");

        // Hapus tanda hubung di awal dan akhir string
        $journal = trim($journal, " -");
        $journal = trim($journal, " -0-9\(\)");

        // Hapus spasi dan koma di awal dan akhir string
        $journal = trim($journal, " ,");

        return $journal;
    }

    // ... tambahkan method scrapeGoogleScholar() dan method lainnya sesuai kebutuhan
}
