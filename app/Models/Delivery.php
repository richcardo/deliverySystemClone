<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable=['name','address','number','price','pos','rider_id'];

    public static function list($input)
    {
        return Delivery::where('address', 'LIKE', "%$input%")->
                        orWhere('name', 'LIKE', "%$input%")
                        ->get();
    }

    public function rider()
    {
        return $this->belongsTo(Rider::class);
    }
}
