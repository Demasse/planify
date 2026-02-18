<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    //
    protected $fillable = [
        'user_id',
        'label',
        'scheduled_at',   // Pour l'heure
        'scheduled_date', // POUR LE JOUR (C'est ça qui manquait !)
        'is_completed',
    ];

    // Optionnel : Pour que Laravel traite ces champs comme des dates
    protected $casts = [
        'scheduled_date' => 'date',
        'is_completed' => 'boolean',
    ];
    // On définit que chaque tâche appartient à un utilisateur
    public function user(): BelongsTo{

        return $this->belongsTo(User::class);
    }

}
