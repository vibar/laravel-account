<?php

namespace Vibar\Account\Notifications;


use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ActivationLinkNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * The activation account token.
     *
     * @var string
     */
    public $token;

    /**
     * Create a notification instance.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's channels.
     *
     * @param  mixed  $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = config('app.url').route('activation.process', $this->token, false);

        return (new MailMessage)
            ->greeting(trans('account::activation.email.greeting', ['name' => $notifiable->name]))
            ->subject(trans('account::activation.email.subject'))
            ->line(trans('account::activation.email.line1'))
            ->action(trans('account::activation.email.action'), $url)
            ->line(trans('account::activation.email.line2'));
    }
}
