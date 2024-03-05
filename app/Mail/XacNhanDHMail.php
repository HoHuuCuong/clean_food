<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class XacNhanDHMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $info;
    protected $gioHang;

    public function __construct($info, $gioHang)
    {
        $this->info     = $info;
        $this->gioHang  = $gioHang;
    }

    public function build()
    {
        return $this->subject('Xác nhận đơn đặt hàng')
                    ->view('mail.xacnhandonhang', [
                        'gioHang'   =>  $this->gioHang,
                        'info'      =>  $this->info,
                    ]);
    }
}
