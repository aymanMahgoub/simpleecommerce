<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Product;
use App\Category;
use Laracasts\Flash;
class productController extends Controller
{
    
    public function index()
    {
        $product = Product::latest('created_at')->paginate(10);

        $productCount = Product::all()->count();
        
        return view('product.show',compact('product','productCount'));
    }

    public function create()
    {
        
        $categories = Category::whereNull('parent_id')->get();
        
        return view('product.add', compact('categories'));
    }

    public function store(Request $request)
    {
        $featured = Input::has('featured') ? true : false;

        $product_name =  str_replace("/", " " ,$request->input('product_name'));

        $product = Product::create([
            'product_name' => $product_name,
            'product_qty' => $request->input('product_qty'),
            'price' => $request->input('price'),
            'reduced_price' => $request->input('reduced_price'),
            'cat_id' => $request->input('cat_id'),
            'featured' => $featured,
            'description' => $request->input('description'),
        ]);

        $product->save();

        flash()->success('Success', 'Product created successfully!');
       

        $product = Product::latest('created_at')->paginate(10);

        $productCount = Product::all()->count();
        
        return view('product.show',compact('product','productCount'));
     }

    public function show($id)
    {
        
    }

    public function edit($id)
    {
        $product = Product::where('id', '=', $id)->find($id);

        $categories = Category::whereNull('parent_id')->get();

         return view('product.edit', compact('product', 'categories'));

    }

    public function update(Request $request, $id)
    {
        $featured = Input::has('featured') ? true : false;

        $product = Product::findOrFail($id);

        $product->update(array(
            'product_name' => $request->input('product_name'),
            'product_qty' => $request->input('product_qty'),
            'price' => $request->input('price'),
            'reduced_price' => $request->input('reduced_price'),
            'cat_id' => $request->input('cat_id'),
            'featured' => $featured,
            'description' => $request->input('description'),
        ));

        $product->update($request->all());
        flash()->success('Success', 'Product updated successfully!');
        
        $product = Product::latest('created_at')->paginate(10);

        $productCount = Product::all()->count();
        
        return view('product.show',compact('product','productCount'));
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();

        $product = Product::latest('created_at')->paginate(10);

        $productCount = Product::all()->count();
        
        return redirect('product')->with('product','productCount');
    }

    public function categoryAPI() {
       
        $input = Input::get('option');

        $category = Category::find($input);

        $subcategory = $category->children();

        return \Response::make($subcategory->get(['id', 'category']));
    }

     public function displayImageUploadPage($id) {

        $product = Product::where('id', '=', $id)->get();

       
        return view('product.upload', compact('product'));
    }
    
     public function showproduct($product_name) {

        $product = Product::ProductLocatedAt($product_name);
 
        return view('visitor.show_product', compact('product'));
    }
}
