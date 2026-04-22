<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class VerifyEmailNotification extends Notification
{
    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );

        return (new MailMessage)
            ->subject('Verify Your Email - '.config('app.name'))
            ->greeting('Hello **'.$notifiable->name.'**!')
            ->line('Welcome! Thank you for joining us.')
            ->line('Please verify your email address to activate your account and get started.')
            ->action('Verify Email Address', $url)
            ->line('If you did not create an account, you can safely ignore this email.')
            ->line('Best regards,'."\n".config('app.name').' Team');
    }
}
