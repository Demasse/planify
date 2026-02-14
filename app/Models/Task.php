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
        'scheduled_at',
        'is_completed',
    ];

    // On définit que chaque tâche appartient à un utilisateur
    public function user(): BelongsTo{
        
        return $this->belongsTo(User::class);
    }

}
