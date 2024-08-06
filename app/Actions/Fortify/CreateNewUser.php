<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Str;
use GuzzleHttp\Client;
use App\Models\Entidad;
use App\Clases\VariablesPredefinidas;
use App\Models\FormatoEmail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, mixed>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'tipo-de-documento' => ['required', 'string', 'max:255'],
            'nro_documento' => ['required', 'string', 'max:255'],
            'direccion' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'string', 'max:255'],
            'cedula_pdf' => ['required', 'file', 'mimes:pdf', 'max:2048'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $password = Str::random(12);

        if (request()->hasFile('cedula_pdf') && request()->file('cedula_pdf')->isValid()) {
            $path = request()->file('cedula_pdf')->store('pdfs', 'public');
        } else {
            throw new \Exception('Error al subir el archivo PDF.');
        }

        $user = User::create([
            'name' => $input['name'],
            'tipo_documento' => $input['tipo-de-documento'],
            'nro_documento' => $input['nro_documento'],
            'direccion' => $input['direccion'],
            'telefono' => $input['telefono'],
            'url_documento' => $path ?? null,
            'email' => $input['email'],
            'password' => Hash::make($password),
        ]);

        $formato_email = FormatoEmail::where('sigla', 'register_user')->first();
        $entidad = Entidad::first();

        $body_correo_predefinido = VariablesPredefinidas::setFrom(['users' => $user->id, 'entidad' => $entidad->id])
            ->replaceString($formato_email->descripcion, 'body')
            ->replaceSpecific('[[password]]', $password)
            ->getReplaceToObject();

        $data_mail = (object)[
            'remitente' => $entidad->remitente,
            'email_e' => (string) $input['email'],
            'bcc' => $entidad->bcc,
            'asunto' => 'Registro de usuario',
            'cuerpo' => $body_correo_predefinido->body, 
        ];

        try {
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
        } catch (\Exception $e) {
            $error = $e;
        }

        return $user;
    }
}
