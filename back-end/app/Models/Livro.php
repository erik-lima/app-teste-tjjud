<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Livro extends Model
{
    /** @use HasFactory<\Database\Factories\LivroFactory> */
    use HasFactory;

    protected $primaryKey = 'cod';

    public $timestamps = false;

    protected $with = ['authors', 'subjects'];

    public $fillable = [
        'titulo',
        'editora',
        'edicao',
        'valor',
        'ano_publicacao',
    ];

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Autor::class, 'livro_autores', 'cod_li', 'cod_au');
    }

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Assunto::class, 'livro_assuntos', 'cod_li', 'cod_as');
    }
}
