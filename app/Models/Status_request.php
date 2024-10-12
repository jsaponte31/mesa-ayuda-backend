<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status_request extends Model
{
    use HasFactory;

    protected $table = 'status_requests';

    protected $fillable = [
        'name',
    ];
}
