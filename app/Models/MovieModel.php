<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CastModel;
use App\Models\CrewModel;
use App\Models\TypesOfMovieModel;
use App\Models\ScreenExpModel;


class MovieModel extends Model
{
    use HasFactory;


    
    public function casts()
    {
        return $this->belongsTo(CastModel::class, 'castid','id');
    }

    public function crews()
    {
        return $this->belongsTo(CrewModel::class, 'crewid','id');
    }

    public function movietypes()
    {
        return $this->belongsTo(TypesOfMovieModel::class, 'movie_type','id');
    }
    public function screenType()
{
    return $this->belongsTo(ScreenExpModel::class, 'screen_type','id');
}

}
