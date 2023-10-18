<?php

namespace App\Notifications\Slack;

use Illuminate\Notifications\Messages\SlackMessage;

class SlackDbRestoreSuccessfulNotification extends SlackNotification
{
    public function toSlack(object $notifiable): SlackMessage
    {
        return (new SlackMessage())
            ->success()
            ->content(
                content: 'Successfully restored the database.',
            );
    }

    public function toArray(object $notifiable): array
    {
        return [
            'content' => 'Successfully restored the database.'
        ];
    }
}
