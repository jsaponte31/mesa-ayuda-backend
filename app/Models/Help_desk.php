<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Help_desk extends Model
{
    use HasFactory;

    protected $table = 'help_desks';

    protected $fillable = [
        'name',
    ];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function administrater()
    {
        return $this->belongsTo(User::class);
    }

    public function technicians()
    {
        return $this->belongsToMany(User::class, 'tecnicos_mesas_relacion', 'help_desk_id', 'tecnico_id')->withTimestamps();
    }
}
