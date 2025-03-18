<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoVisto extends Model
{
    use HasFactory;

    protected $table = 'estado_visto';

    protected $fillable = ['estado'];

    public function seriesPeliculas()
    {
        return $this->hasMany(SeriePelicula::class, 'estado_visto_id');
    }
}
