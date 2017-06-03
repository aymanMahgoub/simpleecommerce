<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Photo;
use App\AddPhotoToProduct;
use Illuminate\Support\Facades\Input as Input;
use Image;
class imageController extends Controller
{

    public function store($id,Request $request) {
       
        $product = Product::LocatedAt($id);
        $photo = $request->file('file');
        (new AddPhotoToProduct($product, $photo))->save();
    
    }


    public function destroy($id) {
        Photo::findOrFail($id)->delete();
        return back();
    }


    public function storeFeaturedPhoto($id, Request $request) {
        $this->validate($request, [
            'featured' => 'required|exists:images,id'
        ]);
        $featured = Input::get('featured');

        Photo::where('product_id', '=', $id)->update(['featured' => 0]);

        Photo::findOrFail($featured)->update(['featured' => 1]);

        return redirect()->back();
    }
}
