<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = "images";
    protected $fillable = ['name', 'path', 'thumbnail_path', 'featured'];

    public function product() {
        return $this->belongsTo('App\Product');
    }

    public function baseDir() {
        return 'public/ProductPhotos/photos';
    }

    public function setNameAttribute($name) {
        $this->attributes['name'] = $name;

        $this->path = $this->baseDir() . '/' . $name;

        $this->thumbnail_path = $this->baseDir() . '/th-' . $name;
    }

    public function delete() {

        \File::delete([
            $this->path,
            $this->thumbnail_path
        ]);

        parent::delete();
    }

}
