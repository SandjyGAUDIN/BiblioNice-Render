<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Abonnement extends Model
{
    protected $table='abonnements';
    protected $primaryKey = 'id_abonnement';
    public $timestamps = false;
        
    protected $fillable=[
        'id_abonnement',
        'id_utilisateur',
        'id_type_abonnement',
        'date_debut',
        'date_fin'
    ];

    public function typeAbonnement()
    {
        return $this->belongsTo(TypeAbonnement::class, 'id_type_abonnement');
    }
}
