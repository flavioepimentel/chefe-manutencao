<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = [
        'ownerId',
        'vehicleId',
        'serviceId',
        'user_id',
    ];

    protected $casts = [
        'ownerId' => 'integer',
        'vehicleId' => 'integer',
        'serviceId' => 'integer',
        'user_id' => 'integer',
    ];
}
