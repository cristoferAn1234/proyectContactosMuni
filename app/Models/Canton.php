<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Canton extends Model
{
    use HasFactory;
    protected $table = 'cantones';

    protected $fillable = [
        'nombre', 'provincia_id'
    ];

    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }

    public function distritos()
    {
        return $this->hasMany(Distrito::class);
    }
}
