<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewUserCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $token;
    private $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token, User $user)
    {
        $this->token = $token;
        $this->user = $user;
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
        $email = $this->user->email;
        $actionUrl = url( "/password/reset/$this->token?new=$email");

        $departments = [];
        foreach($user->departments as $item){
            array_push($departments, $item->name);
        }

        $jobroles = [];
        foreach($user->jobroles as $item){
            array_push($jobroles, $item->name);
        }


        return (new MailMessage)
                    ->from(env('MAIL_FROM'), env('MAIL_SENDER_NAME'))
                    ->subject('Congratulations! Welcome to '.env('APP_NAME'). '. Your account is ready')
                    ->markdown('vendor.notifications.user_registered',
                        [
                            'actionUrl' => $actionUrl, 'actionText' => 'Set Password',
                            'name' => $this->user->name,
                            'batch_no' => $this->user->username,
                            'department' => implode(',', $departments),
                            'jobrole'  => implod('', $jobroles),
                            'role'  => $user->roles->toArray()[0]['name']
                        ]);
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
