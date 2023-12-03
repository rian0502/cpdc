<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendEmailSidangTesis implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $data;
    private $to_name;
    private $to_email;
    private $namafile;

    public function __construct($data, $to_name, $to_email, $namafile)
    {
        //
        $this->data = $data;
        $this->to_name = $to_name;
        $this->to_email = $to_email;
        $this->namafile = $namafile;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $prefix = '';
        $urlpref = '';
        if ((config('app.env') == 'local')) {
            $prefix = 'public/';
            $urlpref = 'http://localhost:8000/';
        } else {
            $prefix = '../../public_html/demo.hasibuanapp.site/';
            $urlpref = 'http://demo.hasibuanapp.site/';
        }
        $to_name = $this->to_name;
        $to_email = $this->to_email;
        $namafile = $this->namafile;
        Mail::send('email.jadwal_seminar', $this->data, function ($message) use ($to_name, $to_email, $namafile, $urlpref) {

            $message->to($to_email, $to_name)->subject('Jadwal Sidang Tesis');
            $message->from('chemistryprogramdatacenter@gmail.com');
            $message->attach($urlpref.'uploads/print_ba_sidang_tesis/' . $namafile);
        });
        unlink(base_path($prefix.'uploads/print_ba_sidang_tesis/' . $namafile));
    }
}
