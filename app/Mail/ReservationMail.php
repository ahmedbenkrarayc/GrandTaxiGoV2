<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

class ReservationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;
    public $status;
    public $qrcode;
    public $currentDate;

    /**
     * Create a new message instance.
     */
    public function __construct($reservation, $status)
    {
        $this->reservation = $reservation;
        $this->status = $status;
        $this->currentDate = Carbon::now()->format('Y-m-d H:i');
        
        if ($status === 'accepted') {
            $data = json_encode([
                'id' => '#'.$this->reservation,
                'date' => $this->currentDate   
            ]);
            
            // Using chillerlan/php-qrcode which requires only GD library (standard in PHP)
            $options = new QROptions([
                'outputType' => QRCode::OUTPUT_IMAGE_PNG,
                'eccLevel' => QRCode::ECC_H,
                'scale' => 5,
                'imageBase64' => true,
            ]);
            
            $qrcode = new QRCode($options);
            $this->qrcode = $qrcode->render($data);
        }
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reservation ' . ucfirst($this->status),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: $this->status === 'accepted' 
                ? 'emails.reservation-accepted' 
                : 'emails.reservation-rejected',
            with: [
                'reservation' => '#'.$this->reservation,
                'currentDate' => $this->currentDate,
                'qrcode' => $this->qrcode ?? null,
            ]
        );
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