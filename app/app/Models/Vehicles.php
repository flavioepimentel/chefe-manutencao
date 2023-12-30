<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicles extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'vehicleName',
        'vehicleOwner',
        'vehicleModel',
        'vehicleYear',
        'vehiclePlate',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'licenseRegistration',
        'vehiclePlate',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'vehicleName' => 'string',
        'vehicleModel' => 'string',
        'vehicleYear' => 'integer'

    ];
}
