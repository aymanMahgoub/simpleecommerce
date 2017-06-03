<?php

namespace App;
use App\Category;
use App\Photo;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'product_name',
        'product_qty',
        'price',
        'reduced_price',
        'cat_id',
        'featured',
        'description',
       ];

    
    public function category() {
        return $this->hasOne('App\Category', 'id');
    }

    public function addPhoto(Photo $Photo) {
        return $this->photos()->save($Photo);
    }


    public function photos() {
        return $this->hasMany('App\Photo');
    }


    public function featuredPhoto() {
        return $this->hasOne('App\Photo')->whereFeatured(true);
    }


    public static function LocatedAt($id) {
        return static::where(compact('id'))->firstOrFail();
    }


    public static function ProductLocatedAt($product_name) {
        return static::where(compact('product_name'))->firstOrFail();
    }

}
