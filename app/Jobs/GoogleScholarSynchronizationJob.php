<?php

namespace App\Jobs;

use App\Models\Dosen;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Services\GoogleScholarSyncService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class GoogleScholarSynchronizationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $dosenId;

    public function __construct($dosenId)
    {

        $this->dosenId = $dosenId;
    }

    public function handle(GoogleScholarSyncService $googleScholarSyncService)
    {
        // Panggil service untuk menangani logika sinkronisasi
        try {
            // foreach ($this->dosenId as $dosen) {
                $googleScholarSyncService->syncDosen($this->dosenId);
            // }
            return response()->json([
                'message' => 'Singkronisasi berhasil',
            ]);
        } catch (\Throwable $th) {

            // Jika terjadi error, log error ke storage/logs/laravel.log
            Log::error($th->getMessage());
        }
    }
    // public function retry()
    // {
    //     if ($this->attempts() < 3) {
    //         return $this->release(10);
    //     }
    // }
}
