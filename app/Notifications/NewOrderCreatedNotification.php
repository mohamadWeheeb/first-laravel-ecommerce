<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\VonageMessage;

class NewOrderCreatedNotification extends Notification
{
    use Queueable;

    protected $order ;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail' ,'database', 'broadcast' , 'vonage'];
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
                    ->greeting('Hello ' . $notifiable->name)
                    ->subject('New Order ')
                    ->line('New Order Has been created.')
                    ->action('View Order', url('/'))
                    ->line('Thank you for using our application!');
    }


    public function toDatabase($notifiable)
    {
        return [
            'title' =>  'New Order ' ,
            'body'      =>  'New Order Has been created.' ,
            'action'    =>  url('/') ,
            'icon'      =>  '' ,
            'order'     =>  $this->order->id
        ];
    }


    public function toBroadcast($notifiable)
    {
        // return [
        //     'title' =>  'New Order ' ,
        //     'body'      =>  'New Order Has been created.' ,
        //     'action'    =>  url('/') ,
        //     'icon'      =>  '' ,
        //     'order'     =>  $this->order->id
        // ];

        $message = New BroadcastMessage([
            'title' =>  'New Order ' ,
            'body'      =>  'New Order Has been created.' ,
            'action'    =>  url('/') ,
            'icon'      =>  '' ,
            'order'     =>  $this->order->id
        ]);
        return $message;
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


    /**
     * Get the Vonage / SMS representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\VonageMessage
     */
    public function toVonage($notifiable)
    {
        return (new VonageMessage)
                    ->content('Your SMS message content');
    }
}
