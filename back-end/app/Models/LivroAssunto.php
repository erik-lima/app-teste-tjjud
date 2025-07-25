<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LivroAssunto extends Model
{
    /** @use HasFactory<\Database\Factories\LivroAssuntoFactory> */
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'cod_as',
        'cod_li'
    ];
}
