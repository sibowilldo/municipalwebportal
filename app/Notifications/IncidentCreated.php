<?php

namespace App\Notifications;

use App\Incident;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class IncidentCreated extends Notification implements ShouldQueue
{
    use Queueable;
    public $user, $incident, $message;

    /**
     * Create a new notification instance.
     *
     * @param User $user
     * @param Incident $incident
     */
    public function __construct(User $user, Incident $incident, $message)
    {
        $this->user = $user;
        $this->incident = $incident;
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->markdown('mail.incident.created');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'id' => $this->incident->id,
            'title' => 'Incident Created | '. $this->incident->reference,
            'name' => $this->incident->name,
            'message'=> $this->message,
            'created_at' => $this->incident->created_at,
            'updated_at' => $this->incident->updated_at
        ];
    }
}
