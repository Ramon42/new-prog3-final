<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mensagem extends Model
{
    protected $fillable = [
        'sent_by', 'id_combinacao', 'msg'
    ];
}
