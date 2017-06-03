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

        // Count all Products in Products Table
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

        // Replace any "/" with a space.
        $product_name =  str_replace("/", " " ,$request->input('product_name'));


            // Create the product in DB
            $product = Product::create([
                'product_name' => $product_name,
                'product_qty' => $request->input('product_qty'),
                //'product_sku' => $request->input('product_sku'),
                'price' => $request->input('price'),
                'reduced_price' => $request->input('reduced_price'),
                'cat_id' => $request->input('cat_id'),
                //'brand_id' => $request->input('brand_id'),
                'featured' => $featured,
                'description' => $request->input('description'),
                //'product_spec' => $request->input('product_spec'),
            ]);

            // Save the product into the Database.
            $product->save();

            // Flash a success message
            flash()->success('Success', 'Product created successfully!');
       // }


        // Redirect back to Show all products page.
        $product = Product::latest('created_at')->paginate(10);

        // Count all Products in Products Table
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


        // Return view with products and categories
        return view('product.edit', compact('product', 'categories'));

    }

    public function update(Request $request, $id)
    {
        $featured = Input::has('featured') ? true : false;

        // Find the Products ID from URL in route
        $product = Product::findOrFail($id);


        
            // Update product
            $product->update(array(
                'product_name' => $request->input('product_name'),
                'product_qty' => $request->input('product_qty'),
                'price' => $request->input('price'),
                'reduced_price' => $request->input('reduced_price'),
                'cat_id' => $request->input('cat_id'),
                'featured' => $featured,
                'description' => $request->input('description'),
                ));


            // Update the product with all the validation rules
            $product->update($request->all());

            // Flash a success message
            flash()->success('Success', 'Product updated successfully!');
        
             $product = Product::latest('created_at')->paginate(10);

        // Count all Products in Products Table
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
        // Get the "option" value from the drop-down.
        $input = Input::get('option');

        // Find the category name associated with the "option" parameter.
        $category = Category::find($input);

        // Find all the children (sub-categories) from the parent category
        // so we can display then in the sub-category drop-down list.
        $subcategory = $category->children();

        // Return a Response, and make a request to get the id and category (name)
        return \Response::make($subcategory->get(['id', 'category']));
    }

     public function displayImageUploadPage($id) {

        // Get the product ID that matches the URL product ID.
        $product = Product::where('id', '=', $id)->get();

       
        return view('product.upload', compact('product'));
    }
    
     public function showproduct($product_name) {

        // Find the product by the product name in URL
        $product = Product::ProductLocatedAt($product_name);

        
        return view('visitor.show_product', compact('product'));
    }
}
