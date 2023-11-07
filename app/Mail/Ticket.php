<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Booking;

class Ticket extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The transaction instance.
     *
     * @var Booking
     */
    public $booking;

    /**
     * The transaction instance.
     *
     * @var array
     */
    public $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Booking $booking, $details)
    {
        $this->booking = $booking;
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->booking->merchant->email, $this->booking->merchant->name)
            ->withSwiftMessage(function($message) {
                $message->setPriority(1);
            })
            ->subject('E-Ticket Booking #' . $this->booking->booking_code)
            ->view('emails.ticket');
    }
}
