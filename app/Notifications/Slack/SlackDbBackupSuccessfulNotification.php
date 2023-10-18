<?php

namespace App\Notifications\Slack;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Notification as FacadesNotification;

class SlackDbBackupSuccessfulNotification extends SlackNotification
{
    public function toSlack(object $notifiable): SlackMessage
    {
        return (new SlackMessage())
            ->success()
            ->content(
                content: 'Successfully backed up the database.',
            );
    }

    public function toArray(object $notifiable): array
    {
        return [
            'content' => 'Successfully backed up the database.',
        ];
    }
}
