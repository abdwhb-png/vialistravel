<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class ModalFormSubmited extends Mailable
{
    use Queueable, SerializesModels;

    protected string $fullName;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public string $section = '',
        public array $data
    ) {
        $f_name = $data['first_name'] ?? '';
        $l_name = $data['last_name'] ?? '';
        $this->fullName = $f_name . ' ' . $l_name;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New form submited on site : ' . $this->section,
            replyTo: [
                new Address($this->data['email'], $this->fullName),
            ],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mails.modal-form-submitted',
            with: [
                'data' => $this->data,
                'section' => $this->section,
            ],
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