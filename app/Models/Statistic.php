<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = [
        'referer_host',
        'session_id',
        'user_agent',
        'datetime_end',
        'user_id',
        'site_id',
    ];


    public function user(){
      return $this->belongsTo(User::class);
    }

    public function site(){
      return $this->belongsTo(Site::class);
    }
}
