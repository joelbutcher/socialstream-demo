<?php

namespace App\Notifications\Slack;

use Illuminate\Notifications\Messages\SlackMessage;

class SlackDbBackupFailedNotification extends SlackNotification
{
    public function toSlack(object $notifiable): SlackMessage
    {
        return (new SlackMessage())
            ->warning()
            ->content(
                content: "Failed to backed up the database: $this->message",
            );
    }

    public function toArray(object $notifiable): array
    {
        return [
            'content' => "Failed to backed up the database: $this->message",
        ];
    }
}
