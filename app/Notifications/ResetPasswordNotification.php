<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class ResetPasswordNotification extends Notification
{
    public $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = URL::temporarySignedRoute(
            'password.reset',
            now()->addMinutes(60),
            [
                'token' => $this->token,
                'email' => $notifiable->email,
            ]
        );

        return (new MailMessage)
            ->subject('Reset Your Password - '.config('app.name'))
            ->greeting('Hello **'.$notifiable->name.'**!')
            ->line('We received a request to reset your password.')
            ->line('Click the button below to choose a new password.')
            ->action('Reset Password', $url)
            ->line('If you did not request a password reset, you can safely ignore this email.')
            ->line('This link will expire in 60 minutes.')
            ->line('Best regards,'."\n".config('app.name').' Team');
    }
}
