<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\MovieModel;
use App\Models\TheaterModel;
use App\Models\ScreenExpModel;


class ShowModel extends Model
{
    use HasFactory;

    public function theaterData()
{
    return $this->belongsTo(TheaterModel::class, 'theater_id');
}

public function screenData()
{
    return $this->belongsTo(ScreenExpModel::class, 'screen_type','id');

}

public function movieData()
{
    return $this->belongsTo(MovieModel::class, 'movie_id','id');
}

}