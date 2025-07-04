<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Usuarios extends Model
{
    //
    use HasFactory;

    protected $table = 'usuarios'; 

    protected $fillable = ['nombre', 'contrasena', 'role', 'correo', 'dirrecion', 'fecha'];
    public $timestamps = true;
}
