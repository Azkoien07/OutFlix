<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use HasFactory;

    protected $table = 'usuarios';

    protected $fillable = ['nombre', 'correo', 'contraseña'];

    protected $hidden = ['contraseña'];

    public function seriesPeliculas()
    {
        return $this->hasMany(SeriePelicula::class, 'usuario_id');
    }
}
