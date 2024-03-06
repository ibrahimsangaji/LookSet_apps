<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Inbound extends Model
{
    protected $fillable = [
        'asset_number',
        'name',
        'rack_id',
        'category_statuses_id',
        'conditions_id',
        'approval_status',
        'created_by',
        'approval_by',
    ];

    public function asset()
    {
        return $this->hasOne(Asset::class, 'asset_number', 'asset_number');
    }

    public function document()
    {
        return $this->hasOne(Document::class, 'asset_number', 'asset_number');
    }

    public function rack()
    {
        return $this->belongsTo(Rack::class, 'rack_id');
    }

    public function categorystatus()
    {
        return $this->belongsTo(Asset::class, 'category_statuses_id', 'category_statuses_id');
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
