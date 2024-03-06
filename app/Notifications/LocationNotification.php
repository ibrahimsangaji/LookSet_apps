<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LocationNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    private $document;
    public function __construct($document)
    {
        $this->document = $document;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'conditions' => $this->document->condition->type,
            'number' => $this->document->document_number,
            'message' => 'Document data has been created new '. $this->document->document_number,
            'link' => '/locations',
            'iconClass' => 'icon-circle bg-primary',
            'icon' => 'fas fa-file-alt text-white',
        ];
    }
}
