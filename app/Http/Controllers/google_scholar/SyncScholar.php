<?php

namespace App\Http\Controllers\google_scholar;

use Carbon\Carbon;
use App\Models\Dosen;
use GuzzleHttp\Client;
use App\Models\SyncHistory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PublikasiDosen;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\AnggotaPublikasiDosen;
use Illuminate\Support\Facades\Crypt;
use Symfony\Component\DomCrawler\Crawler;
use App\Services\GoogleScholarSyncService;
use App\Http\Requests\StorePublikasiRequest;

class SyncScholar extends Controller
{

    protected $googleScholarSyncService;

    public function __construct(GoogleScholarSyncService $googleScholarSyncService)
    {
        $this->googleScholarSyncService = $googleScholarSyncService;
    }
    public function syncAllDosen()
    {
        if (SyncHistory::whereDate('updated_at', now()->toDateString())->exists()) {
            return redirect()->back()->with('error', 'Singkronisasi telah dilakukan, silahkan coba lagi besok');
        } else {
            // Update or create synchronization history
            SyncHistory::updateOrCreate([], ['updated_at' => now()]);

            try {

                $dosenId = Dosen::whereNotNull('url_google_scholar')->get();
                foreach ($dosenId as $dosen) {
                    dispatch(new \App\Jobs\GoogleScholarSynchronizationJob($dosen->id));
                    // $this->googleScholarSyncService->syncDosen($dosen->url_google_scholar);
                }
                return redirect()->back()
                    ->with('success', 'Singkronisasi berjalan');
            } catch (\Throwable $th) {
                return response()->json([
                    'message' => 'Singkronisasi gagal',
                    'error' => $th->getMessage(),
                ], 500);
            }
        }
        // if (SyncHistory::whereDate('updated_at', now()->toDateString())->exists()) {
        //     return redirect()->back()->withErrors(['validation_error' => 'Singkronisasi telah dilakukan, silahkan coba lagi besok']);
        // }

        // // Update or create synchronization history
        // SyncHistory::updateOrCreate([], ['updated_at' => now()]);

        // $dosenId = Dosen::whereNotNull('url_google_scholar')->get();
        // foreach ($dosenId as $dosen) {
        //     dispatch(new \App\Jobs\GoogleScholarSynchronizationJob($dosen->id));
        //     // $this->googleScholarSyncService->syncDosen($dosen->url_google_scholar);


        //     return redirect()->route('jurusan.publikasi.index')->with('success', 'Singkronisasi berjalan');
        // }
    }
}



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
