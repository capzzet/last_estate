<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_type', 'deal_type', 'city', 'address', 'rooms', 'price', 'floor', 'total_floors', 'area', 'balcony', 'bathroom', 'view', 'renovation', 'house_type', 'description', 'agent_id',
    ];

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function images()
    {
        return $this->hasMany(AdvertisementImage::class);
    }
}
