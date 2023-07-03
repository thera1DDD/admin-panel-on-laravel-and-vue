<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FeedbackNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    protected $name;
    protected $phone;
    protected $question;

    public function __construct(array $data)
    {
//        $this->name = $data['name'];
//        $this->phone = $data['phone'];
//        $this->question = $data['question'];
        $this->data = $data;
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
        return (new MailMessage)
            ->subject('Обратная связь')
            ->view('emails.feedback', ['data' => $this->data]);
//                    ->subject('Обратная связь')
//                    ->line('Имя пользователя: ' . $this->name)
//                    ->line('Телефон пользователя: ' . $this->phone)
//                    ->line('Вопрос: '. $this->question);
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
