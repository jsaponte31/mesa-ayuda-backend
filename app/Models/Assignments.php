<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignments extends Model
{
    use HasFactory;

    protected $table = 'assignments';

    protected $fillable = [
        'date_assignment',
        'date_completion',
        'technical_description',
    ];

    public function request()
    {
        return $this->belongsTo(Request::class);
    }

    public function technical()
    {
        return $this->belongsTo(User::class);
    }
}
