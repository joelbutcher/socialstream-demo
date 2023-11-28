<?php

namespace App\Notifications\Slack;

use Illuminate\Notifications\Messages\SlackMessage;

class SlackAppRefreshSuccessfulNotification extends SlackNotification
{
    public function toSlack(object $notifiable): SlackMessage
    {
        return (new SlackMessage())
            ->success()
            ->content(
                content: 'Successfully refreshed the app.',
            );
    }

    public function toArray(object $notifiable): array
    {
        return [
            'content' => 'Successfully refreshed the app.'
        ];
    }
}
