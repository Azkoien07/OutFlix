<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeriePelicula extends Model
{
    use HasFactory;

    protected $table = 'series_peliculas';

    protected $fillable = ['nombre', 'usuario_id', 'estado_visto_id', 'categoria_id'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function estadoVisto()
    {
        return $this->belongsTo(EstadoVisto::class, 'estado_visto_id');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
}
