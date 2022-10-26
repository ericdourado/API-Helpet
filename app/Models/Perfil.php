<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;
    protected $table = 'Perfil';

    public function User()
    {
        return $this->belongsTo('App\Models\User');
    }
}
