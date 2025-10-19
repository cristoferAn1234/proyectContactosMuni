<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Canton;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Provincia extends Model
{
    use HasFactory;
    protected $table = 'provincias';

    protected $fillable = [
        'nombre'
    ];

    public function organizaciones()
    {
        return $this->hasMany(Organizacion::class);
    }
    public function cantones()
    {
        return $this->hasMany(Canton::class);
    }

}