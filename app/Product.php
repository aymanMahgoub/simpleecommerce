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

    //protected $gaurded = ['id'];


    /**
     * One Product can have one Category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category() {
        return $this->hasOne('App\Category', 'id');
    }


    // do same thing above for category() if you want to show what category a certain product is under in products page.



    /**
     * Save a Product to the ProductPhoto instance.
     *
     * @param ProductPhoto $ProductPhoto
     * @return Model
     */
    public function addPhoto(Photo $Photo) {
        return $this->photos()->save($Photo);
    }


    /**
     * One Product can have many photos.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos() {
        return $this->hasMany('App\Photo');
    }


    /**
     * Return a product can have one featured photo where "featured" column = true (or 1)
     *
     * @return mixed
     */
    public function featuredPhoto() {
        return $this->hasOne('App\Photo')->whereFeatured(true);
    }


    /**
     * Show a product when clicked on (Admin side).
     *
     * @param $id
     * @return mixed
     */
    public static function LocatedAt($id) {
        return static::where(compact('id'))->firstOrFail();
    }


    /**
     * Show a Product when clicked on.
     *
     * @param $product_name
     * @return mixed
     */
    public static function ProductLocatedAt($product_name) {
        return static::where(compact('product_name'))->firstOrFail();
    }

}
