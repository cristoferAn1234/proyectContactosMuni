<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipalidad extends Model
{
 protected $tabble = 'municipalidades';
 protected $fillable = ['nombre','id_provincia'];
 public function provincia(){
return $this->belongsTO(Provincia::class, 'id_provincia', 'id');

 }
}
