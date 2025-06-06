<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pedido extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'usuario_id',  
        'articulo_id',
        'cantidad',
        'total',
        'fecha_pedido',
        'estado',
        'direcion_envio',
        'metodo_pago',
    ];
    
    protected $table = 'pedidos'; 

    public function articulo()
    {
        return $this->belongsTo(Articulos::class, 'articulo_id');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuarios::class, 'usuario_id');
    }

}
