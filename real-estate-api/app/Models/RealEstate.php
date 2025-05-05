<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RealEstate extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'real_state_type',
        'street',
        'external_number',
        'internal_number',
        'neighborhood',
        'city',
        'country',
        'rooms',
        'bathrooms',
        'comments'
    ];

    protected $casts = [
        'bathrooms' => 'decimal:2'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function getCountryAttribute($value)
    {
        return strtoupper($value);
    }

    public function setCountryAttribute($value)
    {
        $this->attributes['country'] = strtoupper($value);
    }
}
