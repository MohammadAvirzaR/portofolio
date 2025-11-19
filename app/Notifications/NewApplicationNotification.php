<?php

namespace App\Notifications;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewApplicationNotification extends Notification
{
    use Queueable;

    protected $application;

    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'applicant' => $this->application->user->name,
            'job' => $this->application->job->title,
            'message' => 'Lamaran baru telah masuk.',
            'application_id' => $this->application->id,
        ];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'applicant' => $this->application->user->name,
            'job' => $this->application->job->title,
            'message' => 'Lamaran baru telah masuk.',
            'application_id' => $this->application->id,
        ];
    }
}
