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

        // Set the path of photo
        $this->path = $this->baseDir() . '/' . $name;

        // Set the thumbnail path of photo
        $this->thumbnail_path = $this->baseDir() . '/th-' . $name;
    }

    public function delete() {

        // Delete path and thumbnail_path of photo
        \File::delete([
            $this->path,
            $this->thumbnail_path
        ]);

        parent::delete();
    }

}
