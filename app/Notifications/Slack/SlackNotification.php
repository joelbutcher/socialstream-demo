<?php

namespace App\Notifications\Slack;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Notification as FacadesNotification;

abstract class SlackNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    final public function __construct(
        protected ?string $message = null
    ) {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    final public function via(object $notifiable): array
    {
        return ['slack'];
    }

    abstract public function toSlack(object $notifiable): SlackMessage;

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    abstract  public function toArray(object $notifiable): array;

    final public static function send(?string $message = null): void
    {
        FacadesNotification::route('slack', config('services.slack.webhook'))
            ->notify(new static($message));
    }
}
