<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    /** @use HasFactory<\Database\Factories\AutorFactory> */
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = 'cod';

    public $table = 'autores';

    public $fillable = [
        'nome',
    ];
}
