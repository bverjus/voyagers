<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voyage extends Model
{
    use HasFactory;

    protected $fillable = ['itineraires', 'recommandation', 'lieu', 'type', 'nombre_personnes', 'nombre_jours', 'budget'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
