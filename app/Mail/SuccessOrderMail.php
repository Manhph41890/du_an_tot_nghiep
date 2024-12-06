<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SuccessOrderMail extends Mailable
{
    use Queueable, SerializesModels;
    public $order;
    public $ho_ten;
    /**
     * Create a new message instance.
     */
    public function __construct($order, $ho_ten)
    {
        $this->order = $order;
        $this->ho_ten = $ho_ten;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->subject('Đặt hàng thành công')
            ->view('auth.success_order')
            ->with([
                'order' => $this->order,
                'ho_ten' => $this->ho_ten,
            ]);
    }
    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Success Order Mail');
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(view: 'auth.success_order');
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
