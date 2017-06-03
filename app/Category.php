<?php

namespace App;
use App\Product;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['category'];


    public function parent() {
        return $this->belongsTo('App\Category', 'parent_id');
    }

    public function children() {
        return $this->hasMany('App\Category', 'parent_id');
    }


    public function product() {
        return $this->hasMany('App\Product', 'id');
    }


    public static function boot() {
        parent::boot();
        Category::deleting(function($category) {
            foreach($category->children as $subcategory){
                $subcategory->delete();
            }
        });
    }

}
