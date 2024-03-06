<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Document extends Model
{
    protected $fillable = [
        'document_number',
        'asset_number',
        'sto_number',
        'name',
        'device_id',
        'software_id',
        'rack_id',
        'category_statuses_id',
        'conditions_id',
        'locations_id',
        'created_by',
        'approval_by',
        'explanation',
        'pic',
    ];

    public function inbound()
    {
        return $this->belongsTo(Inbound::class, 'asset_number', 'asset_number');
    }

    public function outbound()
    {
        return $this->belongsTo(Outbound::class, 'sto_number', 'sto_number');
    }

    public function device()
    {
        return $this->belongsTo(Device::class, 'device_id');
    }

    public function condition()
    {
        return $this->belongsTo(Condition::class, 'conditions_id');
    }

    public function division()
    {
        return $this->belongsTo(Division::class, 'locations_id');
    }

    public function software()
    {
        return $this->belongsTo(Software::class, 'software_id');
    }

    public function rack()
    {
        return $this->belongsTo(Rack::class, 'rack_id');
    }

    public function createdUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approvalUser()
    {
        return $this->belongsTo(User::class, 'approval_by');
    }

}
