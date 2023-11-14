<?php

namespace App\Http\Controllers\google_scholar;

use Carbon\Carbon;
use App\Models\Dosen;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PublikasiDosen;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\AnggotaPublikasiDosen;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\StorePublikasiRequest;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class SyncScholar extends Controller
{

    // regex ^https:\/\/scholar\.google\.com\/citations\?user=[A-Za-z0-9]+$
    //cut url
    // http://googleschoolarapi.testing/api/scrape-google-scholar/XDoJWnMAAAAJ
    //     $url = "https://scholar.google.com/citations?user=tpCRK8kAAAAJ&hl=id&oi=sra";
    // ^: Memastikan bahwa string dimulai dengan URL.
    // https:\/\/scholar\.google\.com\/citations\?user=: Mencocokkan dengan awalan URL yang mencakup https://scholar.google.com/citations?user=.
    // [A-Za-z0-9]+: Mencocokkan karakter yang terdiri dari huruf besar, huruf kecil, dan angka untuk bagian user (ID pengguna).
    // $: Memastikan bahwa string berakhir setelah parameter user.
    // // Cari posisi karakter '&' dalam URL
    // $pos = strpos($url, '&');

    // if ($pos !== false) {
    //     // Potong URL hingga karakter '&' pertama kali muncul
    //     $newUrl = substr($url, 0, $pos);
    //     echo $newUrl;
    // } else {
    //     echo "URL tidak berubah: " . $url;
    // }

    public function scrapeGoogleScholar(Request $request, $userId)
    {
        $cstart = 0;
        $pagesize = 80;
        $baseUrl = "https://scholar.google.com/citations?user=" . urlencode($userId);

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
            sleep(1);
        } while (count($pagePublications) > 0);

        // Filter out publications with null values
        $publications = array_filter($publications, function ($publication) {
            return $publication['title'] !== null && $publication['journal'] !== null;
        });

        // Sort publications by year, placing non-numeric years at the end
        usort($publications, function ($a, $b) {
            $yearA = is_numeric($a['year']) ? $a['year'] : PHP_INT_MAX;
            $yearB = is_numeric($b['year']) ? $b['year'] : PHP_INT_MAX;

            return $yearA - $yearB;
        });

        return response()->json([
            'name' => $name,
            'affiliation' => $affiliation,
            'publications' => $publications,
        ]);
    }

    private function extractPublications(Crawler $crawler)
    {
        return $crawler->filter('.gsc_a_tr')->each(function (Crawler $node) {
            $titleNode = $node->filter('.gsc_a_at');
            $title = $titleNode->count() > 0 ? $titleNode->text() : null;

            $urlNode = $node->filter('.gsc_a_at');
            $url = $urlNode->count() > 0 ? $urlNode->attr('href') : null;

            $authorsNode = $node->filter('.gs_gray')->eq(0);
            $authors = $authorsNode->count() > 0 ? $authorsNode->text() : null;

            $journalNode = $node->filter('.gs_gray')->eq(1);
            $journal = $journalNode->count() > 0 ? $journalNode->text() : null;

            $citationsNode = $node->filter('.gsc_a_ac');
            $citations = $citationsNode->count() > 0 ? $citationsNode->text() : null;

            $yearNode = $node->filter('.gsc_a_h');
            $year = $yearNode->count() > 0 ? $yearNode->text() : null;

            return [
                'title' => $title,
                'url' => "scholar.google.com" . $url,
                'authors' => $authors,
                'journal' => $journal,
                'citations' => $citations,
                'year' => $year,
                // Add other data fields here
            ];
        });
    }

    private function isDataFound(array $publications): bool
    {
        foreach ($publications as $publication) {
            if ($publication['title'] === null || $publication['journal'] === null) {
                return false;
            }
        }
        return true;
    }
}
