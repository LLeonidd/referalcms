<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function user(){
      return $this->belongsTo(User::class);
    }

    public function site(){
      return $this->belongsTo(Site::class);
    }
}