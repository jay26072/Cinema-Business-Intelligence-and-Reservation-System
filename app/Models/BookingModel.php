<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ShowModel;
use App\Models\MovieModel;
use App\Models\UserModel;
use App\Models\TheaterModel;
use App\Models\ScreenExpModel;

class BookingModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'show_id',
        'movie_id',
        'theater_id',
        'booking_reference',
        'seat_number',
        'screen_type',
        'screen_no',
        'language',
        'total_price',
        'gst_amount',
        'final_price',
        'payment_method',
        'payment_status',
        'booking_status',
        'expires_at',
        'discount_amount',
        'promo_code',
    ];

    public function showData()
    {
        return $this->belongsTo(ShowModel::class, 'show_id', 'id');
    }

    public function movieData()
    {
        return $this->belongsTo(MovieModel::class, 'movie_id', 'id');
    }

    public function userData()
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'id');
    }

    public function theaterData()
    {
        return $this->belongsTo(TheaterModel::class, 'theater_id', 'id');
    }
    public function screenData()
    {
        return $this->belongsTo(ScreenExpModel::class, 'screen_type', 'id');
    }
}
