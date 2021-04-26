<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $table = 'cars';
    protected $primarykey = 'id';
    public $timestamps = true;
    protected $fillable = ['name','founded','description','img_path','user_id'];
    //protected $hidden = ['name','founded'];
    //protected $visible = [];

    public function carModels() {
        return $this->hasMany(CarModel::class);
    }

    // Define a has many through relationship
    public function engines() {
        return $this->hasManyThrough(Engine::class, CarModel::class,
                                    'car_id', //engine foreign key,
                                    'model_id' // car_model foreign key
                                    );
    }

    //Define a has one through relationship
    public function productionDate() {
        return $this->hasOneThrough(CarProductionDate::class,CarModel::class,
                                    'car_id', 'model_id');
    }

    public function products() {
        return $this->belongsToMany(Product::class);
    }

}
