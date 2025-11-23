<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'role',
        'aprobado',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
 

    public function createdContactos()
    {
        return $this->hasMany(Contacto::class, 'created_by');
    }
    public function updatedContactos()
    {
        return $this->hasMany(Contacto::class, 'updated_by');
    }
    public function createdOrganizaciones()
    {
        return $this->hasMany(Organizacion::class);
    }

    // Scope para filtrar usuarios por estado de aprobación
    public function scopeByAprobado($query, $estado)
{
    return $query->where('aprobado', $estado);
}
}
