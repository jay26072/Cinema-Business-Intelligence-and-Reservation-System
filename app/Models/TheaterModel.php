<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CityModel;
use App\Models\ShowModel;

class TheaterModel extends Model
{
    use HasFactory;
    public function CityData()
    {
        return $this->belongsTo(CityModel::class, 'cityid','id');
    }

    public function ShowData()
    {
        return $this->hasMany(ShowModel::class, 'theater_id','id');
    }
}
