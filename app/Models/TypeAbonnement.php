<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeAbonnement extends Model
{
    protected $table='type_abonnements';
    protected $primaryKey = 'id_type_abonnement';
    public $timestamps = false;
    
    protected $fillable=[
        'id_type_abonnement',
        'nom',
        'prix'
    ];

    public function abonnements()
    {
        return $this->hasMany(Abonnement::class, 'id_type_abonnement');
    }
}
