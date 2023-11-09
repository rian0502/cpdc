<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendEmailKerjaPraktik implements ShouldQueue
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
        $this->data = $data;
        $this->to_name = $to_name;
        $this->to_email = $to_email;
        $this->namafile = $namafile;
    }

    public function handle()
    {
        //
        $to_name = $this->to_name;
        $to_email = $this->to_email;
        $namafile = $this->namafile;
        Mail::send('email.jadwal_seminar', $this->data, function ($message) use ($to_name, $to_email, $namafile) {
            $message->to($to_email, $to_name)->subject('Jadwal Seminar Kerja Praktik');
            $message->from('chemistryprogramdatacenter@gmail.com');
            $message->attach('public/uploads/print_ba_kp/'.$namafile);
        });
        unlink(('public/uploads/print_ba_kp/'.$namafile));
    }
}
