<?php

namespace App\Mail;

use App\Models\Lead;
use App\Models\Listing;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ListingLeadReceived extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Listing $listing,
        public Lead $lead,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New traveler inquiry for '.$this->listing->title,
            replyTo: [$this->lead->guest_email],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.listing-lead-received',
        );
    }
}
