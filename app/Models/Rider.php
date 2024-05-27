<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Rider extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable=['name','surname','img','number','transport','fuel','total'];

    public function deliveries()
    {
        return $this->hasMany(Delivery::class);
    }
    
    public function teSearchableArray()
    {
        return [
            'name' => $this->name,
            'surname'=> $this->surname, 
            'number' => $this->number, 
        ];
    }
}
