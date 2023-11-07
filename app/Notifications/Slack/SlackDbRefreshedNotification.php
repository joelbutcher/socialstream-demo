<?php

namespace App\Notifications\Slack;

use Illuminate\Notifications\Messages\SlackMessage;

class SlackDbRefreshedNotification extends SlackNotification
{
    public function toSlack(object $notifiable): SlackMessage
    {
        return (new SlackMessage())
            ->warning()
            ->content(
              content: 'The database was refreshed!'
            );
    }

    public function toArray(object $notifiable): array
    {
        return [
            'content' => 'The database was refreshed!',
        ];
    }
}
