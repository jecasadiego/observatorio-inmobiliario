<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\CustomResetPasswordNotification;


class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;


    const ESTADO_PENDIENTE = 0;
    const ESTADO_APROBADO = 1;
    const ESTADO_RECHAZADO = 2;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'tipo_documento',
        'super_admin',
        'nro_documento',
        'direccion',
        'telefono',
        'estado',
        'active',
        'url_documento',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPasswordNotification($token, (string) $this->email));
    }

    public function getEstadoTextoAttribute()
    {
        switch ($this->estado) {
            case self::ESTADO_PENDIENTE:
                return 'Pendiente';
            case self::ESTADO_APROBADO:
                return 'Aprobado';
            default:
                return 'No aprobado';
        }
    }

    public function getEstadoNumero()
    {
        return $this->estado;
    }

    public function getCedulaPathAttribute()
    {
        $cedula_path = $this->url_documento;
        $cedula_path = asset('storage/' . $cedula_path); 
        return $cedula_path;
    }

}
