<?php

namespace App\Notifications;

use App\Models\Pharmacist;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewOrder extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $order;
    // public $pharmacist;
    public function __construct($order)
    {
        $this->order=$order;
        // $this->pharmacist=Pharmacist::find($order->pharmacist_id);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }


    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $pharmacist=Pharmacist::find($this->order->pharmacist_id);
        return [
            'order_id'=>$this->order->id,
            'pharmacist_name'=>$pharmacist->name,
            'message'=>'you have recieved a new order',
        ];
    }
}
