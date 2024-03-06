<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inlocation extends Model
{
    protected $fillable = [
        'loc_number',
        'sto_number',
        'location_id',
    ];

    public function outbound()
    {
        return $this->hasOne(Outbound::class, 'sto_number', 'sto_number');
    }
}
