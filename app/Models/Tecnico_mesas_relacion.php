<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tecnico_mesas_relacion extends Model
{
    use HasFactory;

    protected $table = 'tecnicos_mesas_relacion';

    protected $fillable = [
        'tecnico_id',
        'help_desk_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'tecnico_id');
    }
    public function helpDesk()
    {
        return $this->belongsTo(Help_desk::class, 'help_desk_id');
    }
}
