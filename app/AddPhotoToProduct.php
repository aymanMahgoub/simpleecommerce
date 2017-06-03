<?php

namespace App;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;

class AddPhotoToProduct {

    /**
     * @var Product
     */
    protected $product;


    /**
     * The UploadedFile Instance.
     *
     * @var UploadedFile
     */
    protected $file;


    /**
     * Create a new AddPhotoToProduct form object.
     *
     * @param Product $product
     * @param UploadedFile $file
     * @param Thumbnail|null $thumbnail
     */
    public function __construct(Product $product, UploadedFile $file, Thumbnail $thumbnail = null) {
        $this->product = $product;
        $this->file = $file;
        $this->thumbnail = $thumbnail ?: new Thumbnail;
    }


  
    public function save() {

        $photo = $this->product->addPhoto($this->makePhoto());

        $this->file->move($photo->baseDir(), $photo->name);

        $this->thumbnail->make($photo->path, $photo->thumbnail_path);
    }


    protected function makePhoto() {
        return new Photo(['name' => $this->makeFilename()]);
    }

    protected function makeFilename() {

        $name = sha1 (
            time() . $this->file->getClientOriginalName()
        );

        $extension = $this->file->getClientOriginalExtension();

        return "{$name}.{$extension}";
    }

}