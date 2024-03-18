<?php

namespace App\Notifications;

use App\Models\Warehouse;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderSentNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $order;
    public function __construct($order)
    {
        $this->order=$order;
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
     * Get the mail representation of the notification.
     */
   

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $warehouse=Warehouse::find($this->order->warehouse_id);
        return [
            'order_id'=>$this->order->id,
            'warehouse_name'=>$warehouse->name,
            'message'=>'your order has been sent'
        ];
    }
}
