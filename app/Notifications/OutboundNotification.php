<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OutboundNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    private $outbound;
    public function __construct($outbound)
    {
        $this->outbound = $outbound;
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
            'conditions' => $this->outbound->condition->type,
            'number' => $this->outbound->sto_number,
            'message' => 'There is data with STO Number   '. $this->outbound->sto_number .' that needs approval.',
            'link' => '/approvals',
            'iconClass' => 'icon-circle bg-warning',
            'icon' => 'fas fa-exclamation-triangle text-white',
        ];
    }
}
