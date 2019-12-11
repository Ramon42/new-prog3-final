<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preferencias_as_users extends Model
{
    protected $fillable = [
        'id_user', 'id_pref', 'id_curso', 'id_campus', 'id_curso'
    ];
}
