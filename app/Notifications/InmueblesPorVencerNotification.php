<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class InmueblesPorVencerNotification extends Notification
{
    use Queueable;

    protected $inmueble;

    public function __construct($inmueble)
    {
        $this->inmueble = $inmueble;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'El inmueble ' . $this->inmueble->nombre_inmueble . ' está a punto de vencer en' . $this->inmueble->dias_restantes . '  días.',
            'inmueble_id' => $this->inmueble->id,
        ];
    }
}
