<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipalidad extends Model
{
 protected $table = 'municipalidades';
 protected $fillable = ['nombre','provincia_id','user_id'];
 public function provincia(){
return $this->belongsTo(Provincia::class);

 }
 public function usuario()
 {
     return $this->belongsTo(User::class);
 }
}
