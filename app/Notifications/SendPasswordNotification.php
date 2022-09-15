<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SimpleMessage;
use Illuminate\Notifications\Notification;

class SendPasswordNotification extends Notification
{
    use Queueable;

    public function __construct(
        private readonly string $password
    ) {
    }

    public function via(): array
    {
        return ['mail'];
    }

    public function toMail(User $user): SimpleMessage
    {
        return (new MailMessage())
            ->subject('Your new account')
            ->greeting("Hello, {$user->first_name}")
            ->line("A new user account has been created for the email. {$user->email}")
            ->line('Your new password is:')
            ->line($this->password)
            ->action('Login Here', url()->route('login'))
            ->line('Thank you for using our application!');
    }
}
