<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SubscribedUserNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */

    public $message;
    public $event;

    public function __construct($message, $event)
    {
        $this->message = $message;
        $this->event = $event;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Exhibition Notification')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line($this->message)
            ->action('View Event', url('/event_notification' . $this->event->id))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => $this->message,
            'link' => url('/event_notification/' . $this->event->id),
        ];
    }
}
