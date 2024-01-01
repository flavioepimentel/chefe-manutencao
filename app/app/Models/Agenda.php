<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicleOwner',
        'vehicleName',
        'vehicleModel',
        'vehicleYear',
        'vehiclePlate',
        'serviceName',
        'price',
        'items',
        'user_id',
    ];

    protected $casts = [
        'vehicleOwner' => 'string',
        'vehicleName' => 'string',
        'vehicleModel' => 'string',
        'vehicleYear' => 'string',
        'vehiclePlate' => 'string',
        'serviceName' => 'string',
        'price' => 'doble',
        'items' => 'string',
        'user_id' => 'string',
    ];
}
