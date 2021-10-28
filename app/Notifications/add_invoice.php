<?php

namespace App\Notifications;

use App\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class add_invoice extends Notification
{
    use Queueable;
    public $id;
    public $invoice;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
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
     * @return \Illuminate\Notifications\Messages\MailMessage
     */

    public function toDatabase($notification)
    {
        return [
            // 'data' => $this->details['body']
            'id' => $this->invoice->id,
            'title' => ' تم اضافة فاتورة جديدة بواسطة  ',
            'user' => Auth::user()->name,
        ];
    }
}
