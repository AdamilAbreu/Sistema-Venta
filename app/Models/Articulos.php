<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulos extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'nombre',
        'descripcion',
        'foto',
        'precio',
        'categoria_id',
    ];
    //Para poder mostrar el nombre de la categoria, ya que es una llave foranea.
    public function categoria()
    {
        return $this->belongsTo(Categorias::class, 'categoria_id'); 
    }

}
