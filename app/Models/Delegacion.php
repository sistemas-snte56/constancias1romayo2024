<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delegacion extends Model
{
    use HasFactory;
    protected $table = 'delegacions';
    protected $fillable = [
        'id_region',
        'delegacion',
        'sede',
        'nivel',
    ];

    /**
     * Get the region that owns the Delegacion
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function region()
    {
        return $this->belongsTo(Region::class, 'id_region', 'id');
    }
    
    public function maestros()
    {
        return $this->hasMany(Maestro::class, 'id_delegacion');
    }
}
