<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class NewMessageNotification extends Notification
{
    use Queueable;

    public $body;
    public $title;
    public $path;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $user)
    {

        if (!$user) {
            throw new \Exception('User not authenticated');
        }

        $this->body = __('You have a new message from :name', ['name' => $user->name]);
        $this->title = __('New Message');
        $this->path = str_replace('{id}', $user->id, config('paths.user_messages'));
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return[
                'id' => $this->id,
                'title' => $this->title,
                'body' => $this->body,
                'path' => $this->path,
            ];
    }
}
