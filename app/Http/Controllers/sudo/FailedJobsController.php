<?php

namespace App\Http\Controllers\sudo;

use App\Http\Controllers\Controller;
use App\Jobs\ImportMahasiswaS1Job;
use App\Models\ModelFailedJobs;
use Illuminate\Http\Request;

class FailedJobsController extends Controller
{
    //

    public function index()
    {
        $jobs = ModelFailedJobs::select('id', 'uuid', 'failed_at', 'exception')->get();
        return view('sudo.jobs.index', compact('jobs'));
    }
    public function retry($id)
    {
        // Temukan job yang sesuai berdasarkan UUID
        $failedJob = ModelFailedJobs::where('uuid', $id)->first();

        if ($failedJob) {
            // Ambil payload job
            $payload = json_decode($failedJob->payload);

            // Cek apakah payload memiliki informasi kelas job (displayName)
            if (isset($payload->displayName)) {
                // Buat instance baru dari job dan kembalikan untuk di-dispatch
                $retryJob = $this->getJobInstanceByName($payload->displayName, $payload->data);
                $retryJob->retry($payload->data)->dispatch();

                // Hapus record job yang gagal dari database
                $failedJob->delete();

                return redirect()->route('sudo.failed_jobs.index')->with('success', 'Job retried successfully');
            }
        }

        return redirect()->route('sudo.failed_jobs.index')->with('error', 'Job not found or cannot be retried');
    }

    protected function getJobInstanceByName($jobClassName, $data)
    {
        // Buat instance baru dari kelas job berdasarkan nama kelas
        return new $jobClassName($data);
    }
    public function show($id)
    {
        $job = ModelFailedJobs::where('uuid', $id)->first();
    }

    public function destroy($id)
    {
        $job = ModelFailedJobs::where('uuid', $id)->first();
        $job->delete();
        return redirect()->route('sudo.failed_jobs.index')->with('success', 'Job deleted successfully');
    }
}
