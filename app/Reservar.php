<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservar extends Model
{
    protected $fillable = [
        'dia', 'sala', 'fk_user'
    ];
}
