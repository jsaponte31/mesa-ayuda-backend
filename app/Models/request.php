<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $table = 'requests';

    protected $fillable = [
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function help_desk()
    {
        return $this->belongsTo(Help_desk::class);
    }

    public function status_request()
    {
        return $this->belongsTo(Status_request::class);
    }
}
