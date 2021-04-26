<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    use HasFactory;

    protected $table = 'cars_id';
    protected $primaryKey = 'id';

    // A car model belong to a car
    public function car() {
        return $this->belongsTo(Car::class);
    }

}
