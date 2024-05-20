<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maestro extends Model
{
    use HasFactory;
    protected $table = 'maestros';
    protected $fillable = [
        'id_delegacion',	
        'nombre',	
        'apaterno',	
        'amaterno',	
        'npersonal',	
        'rfc',	
        'id_genero',	
        'telefono',	
        'email',	
        'folio',	
        'codigo_id',	
        'codigo_qr',
    ];

    public function delegacion()
    {
        return $this->belongsTo(Delegacion::class, 'id_delegacion', 'id');
    }    
    public function genero()
    {
        return $this->belongsTo(Genero::class, 'id_genero', 'id');
    }    
}
