<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactFormSubmitted extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Les données du formulaire de contact.
     *
     * @var array
     */
    public $formData;

    /**
     * Créer une nouvelle instance du message.
     *
     * @param  array  $formData
     * @return void
     */
    public function __construct(array $formData)
    {
        $this->formData = $formData;
    }

    /**
     * Construire le message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Nouveau message de contact: ' . $this->formData['subject'];
        
        return $this->subject($subject)
                    ->view('emails.contact-form-submitted')
                    ->with([
                        'formData' => $this->formData,
                    ]);
    }

    /**
     * Obtenir l'enveloppe du message.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        $subject = 'Nouveau message de contact: ' . $this->formData['subject'];
        
        return new Envelope(
            subject: $subject,
        );
    }

    /**
     * Obtenir la définition du contenu du message.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.contact-form-submitted',
            with: [
                'formData' => $this->formData,
            ],
        );
    }

    /**
     * Obtenir les pièces jointes du message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
