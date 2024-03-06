<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outbound extends Model
{
    protected $fillable = [
        'sto_number',
        'name',
        'location_id',
        'category_statuses_id',
        'conditions_id',
        'pic',
        'approval_status',
        'created_by',
        'approval_by',
    ];

    public function asset()
    {
        return $this->hasOne(Asset::class, 'sto_number', 'sto_number');
    }

    public function document()
    {
        return $this->hasOne(Document::class, 'sto_number', 'sto_number');
    }

    public function inlocation()
    {
        return $this->belongsTo(Inlocation::class, 'sto_number', 'sto_number');
    }

    public function division()
    {
        return $this->belongsTo(Division::class, 'location_id');
    }

    public function software()
    {
        return $this->belongsTo(Software::class, 'software_id');
    }

    public function categorystatus()
    {
        return $this->belongsTo(CategoryStatus::class, 'category_statuses_id');
    }

    public function condition()
    {
        return $this->belongsTo(Condition::class, 'conditions_id');
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
