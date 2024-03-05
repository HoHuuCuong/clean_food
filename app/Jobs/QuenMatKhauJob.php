<?php

namespace App\Jobs;

use App\Mail\QuenMatKhauMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class QuenMatKhauJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $data;
    private $email;

    public function __construct($data, $email)
    {
        $this->data     = $data;
        $this->email    = $email;
    }


    public function handle()
    {
        Mail::to($this->email)->send(new QuenMatKhauMail($this->data));
    }
}
