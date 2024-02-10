<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Travel extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'current_loc',
        'destination', 
        'jumlah_passsanger',
        'total', 'nim',
        'id_mobil', 
        'id_travel_agent',
        'nama_sender',
        'no_sender',
        'nama_receiver',
        'no_receiver',
        'berat_paket',
        'status',
        'departure',
        'arrive',
        'jam_departure',
        'jam_arrive',
        'jenis',
        'current_lat',
        'current_long',
        'destination_lat',
        'destination_long'
    ];
    // protected $fillable = [
    //     'nama_address','address'
    // ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    // protected $hidden = [
    //     'password',
    // ];
}
