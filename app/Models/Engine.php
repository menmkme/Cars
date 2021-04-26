<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Engine extends Model
{
    use HasFactory;

    protected $table = 'engines';
    protected $primaryKey = 'id';
    public function car() {
        return $this->belongsTo(CarModel::class, Car::class);
    }
}
