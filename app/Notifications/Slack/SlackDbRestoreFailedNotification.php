<?php

namespace App\Notifications\Slack;

use Illuminate\Notifications\Messages\SlackMessage;

class SlackDbRestoreFailedNotification extends SlackNotification
{
    public function toSlack(object $notifiable): SlackMessage
    {
        return (new SlackMessage())
            ->warning()
            ->content(
                content: "Failed to restore the database: $this->message",
            );
    }

    public function toArray(object $notifiable): array
    {
        return [
            'content' => "Failed to restore the database: $this->message",
        ];
    }
}
