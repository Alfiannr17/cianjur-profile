<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'category', 'description', 'address',
        'latitude', 'longitude', 'kode_desa', 'kode_kecamatan',
        'ticket_price', 'open_time', 'close_time', 'status'
    ];

    public function images(): HasMany
    {
        return $this->hasMany(DestinationImage::class);
    }
}