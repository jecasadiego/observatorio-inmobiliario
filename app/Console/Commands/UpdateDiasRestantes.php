<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Inmuebles;
use Illuminate\Support\Facades\Notification;
use App\Notifications\InmueblesPorVencerNotification;
use App\Models\User;
use App\Models\FormatoEmail;
use App\Models\Entidad;
use App\Clases\VariablesPredefinidas;
use GuzzleHttp\Client;


class UpdateDiasRestantes extends Command
{
    protected $signature = 'inmuebles:update-dias-restantes';
    protected $description = 'Actualizar los días restantes de los inmuebles y enviar notificaciones si quedan 5 días';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $inmuebles = Inmuebles::all();
        foreach ($inmuebles as $inmueble) {
            if ($inmueble->dias_restantes > 0) {
                $inmueble->dias_restantes -= 1;
                
                $inmueble->save();


                if ($inmueble->dias_restantes <= 5 && $inmueble->dias_restantes > 0) {
                    Notification::send(User::all(), new InmueblesPorVencerNotification($inmueble));
                    $this->sendMail($inmueble);
                }
            }else{
                $inmueble->active = 0;
                $inmueble->save();
            }
        }

        $this->info('Días restantes actualizados y notificaciones enviadas.');
    }

    private function sendMail($inmueble){
        $formato_email = FormatoEmail::where('sigla', 'noti_inmueble')->first();

        $user = User::where('id', $inmueble->id_user)->first();

        $body_correo_predefinido = VariablesPredefinidas::setFrom(['users' => $user->id, 'inmuebles' => $inmueble->id])
            ->replaceString($formato_email->descripcion, 'body')
            ->getReplaceToObject();

        $entidad = Entidad::first();

        $data_mail = (object)[
            'remitente' => $entidad->remitente,
            'email_e' => $user->email,
            'bcc' => $entidad->bcc,
            'asunto' => 'Inmueble por vencer',
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
    }
}
