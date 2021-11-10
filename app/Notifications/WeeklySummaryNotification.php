<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Complain;

class WeeklySummaryNotification extends Notification
{
    use Queueable;
    public $manager;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($manager)
    {
        $this->manager = $manager;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $manager = $this->manager;
        $complains = Complain::where('branch_id',$manager->branch_id)->whereDate('created_at','<', now()->subDays(7))->get();
        $total_complains = count($complains);
        $total_reviewed = count($complains->where('reviewed', 1));
        $pending_review = count($complains->where('reviewed', 0));
        return (new MailMessage)
                    ->greeting("Hello $manager->fullName()")
                    ->line("Your Branch Received a Total of $total_complain This Week")
                    ->line("breakdown: ")
                    ->line("Total Reviewed: $total_reviewed")
                    ->line("Pending: $pending_review")
                    ->action('Click here to logon', url('/'))
                    ->line('Thank you!');
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
            //
        ];
    }
}
