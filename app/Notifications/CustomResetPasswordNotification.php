<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

use GuzzleHttp\Client;
use App\Models\Entidad;
use App\Clases\VariablesPredefinidas;
use App\Models\User;
use App\Models\FormatoEmail;

class CustomResetPasswordNotification extends Notification
{
    public $token;
    public $email;

    public function __construct($token, $email)
    {
        $this->token = $token;
        $this->email = (string) $email; // Asegúrate de que email sea un string
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $this->email,
        ], false));

        $user = User::where('email', $this->email)->first();
        $formato_email = FormatoEmail::where('sigla', 'password_reset')->first();
        $entidad = Entidad::first();
        
        $body_correo_predefinido = VariablesPredefinidas::setFrom(['users' => $user->id])
            ->replaceString($formato_email->descripcion, 'body')
            ->replaceSpecific('[[url]]', $url)
            ->getReplaceToObject();


        $data_mail = (object)[
            'remitente' => $entidad->remitente,
            'email_e' => (string) $this->email, // Asegúrate de que sea un string
            'bcc' => $entidad->bcc,
            'asunto' => 'Restablecimiento de Contraseña',
            'cuerpo' => $body_correo_predefinido->body
        ];

        $client = new Client();
        $client->request('POST', 'http://localhost:3001/email', [
            'json' => [
                'remitente' => $data_mail->remitente,
                'to' => $data_mail->email_e,
                'bcc' => $data_mail->bcc,
                'asunto' => $data_mail->asunto,
                'cuerpo' => $data_mail->cuerpo
            ]
        ]);

        return (new MailMessage)
            ->subject('Restablecimiento de Contraseña')
            ->line('Hemos recibido una solicitud para restablecer la contraseña de su cuenta.')
            ->action('Restablecer Contraseña', $url)
            ->line('Si no solicitó un restablecimiento de contraseña, no es necesario realizar ninguna otra acción.');
    }
}

