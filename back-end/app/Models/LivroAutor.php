<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LivroAutor extends Model
{
    /** @use HasFactory<\Database\Factories\LivroAutorFactory> */
    use HasFactory;

    public $table = 'livro_autores';

    public $timestamps = false;

    protected $fillable = [
        'cod_au',
        'cod_li'
    ];
}
