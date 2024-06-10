<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Delivery extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable=['name','address','number','price','pos','rider_id'];

    public static function searchDeliveries($input)
    {
        return Delivery::where('address', 'LIKE', "%$input%")->
                        orWhere('name', 'LIKE', "%$input%")
                        ->get();
    }

    public function rider()
    {
        return $this->belongsTo(Rider::class);
    }

    public function searchableAs(): string
    {
        return 'deliveries_index';
    }

    public function toSearchableArray()
{
    return [
        'id' => (int) $this->id,
        'name' => $this->name,
        'price' => (float) $this->price,
        'address' => $this->address, 
        'number' => $this->number,
    ];
}
}
