<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comentario extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'id_user', 'id_post', 'comentario'
    ];
    protected $dates = [
        'deleted_at'
    ];
}
