<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $fillable = [
        'asset_number',
        'sto_number',
        'name',
        'device_id',
        'software_id',
        'category_statuses_id',
        'explanation',
    ];

    public function inbound()
    {
        return $this->hasOne(Inbound::class, 'asset_number', 'asset_number');
    }

    public function outbound()
    {
        return $this->hasOne(Outbound::class, 'sto_number', 'sto_number');
    }

    public function device()
    {
        return $this->belongsTo(Device::class, 'device_id');
    }

    public function software()
    {
        return $this->belongsTo(Software::class, 'software_id');
    }

    public function categorystatus()
    {
        return $this->belongsTo(CategoryStatus::class, 'category_statuses_id');
    }
}
