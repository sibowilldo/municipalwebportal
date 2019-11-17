<?php

namespace App\Notifications;

use App\Incident;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class IncidentUpdated extends Notification implements ShouldQueue
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
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->markdown('mail.incident.updated');
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
            'title' => 'Incident Updated | '. $this->incident->reference,
            'message'=> $this->message,
            'name' => $this->incident->name,
            'created_at' => $this->incident->created_at,
            'updated_at' => $this->incident->updated_at
        ];
    }
}
