<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InboundNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    private $inbound;
    public function __construct($inbound)
    {
        $this->inbound = $inbound;
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
            'conditions' => $this->inbound->condition->type,
            'number' => $this->inbound->asset_number,
            'message' => 'There is data with Asset Number '. $this->inbound->asset_number .' that needs approval.',
            'link' => '/approvals',
            'iconClass' => 'icon-circle bg-warning',
            'icon' => 'fas fa-exclamation-triangle text-white',
        ];
    }
}
