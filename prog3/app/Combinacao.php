<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Combinacao extends Model
{
    protected $fillable = [
        'id_user1', 'id_user2'
    ];
}
