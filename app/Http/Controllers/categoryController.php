<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use Laracasts\Flash;

class categoryController extends Controller
{ 
    public function index()
    {
        $categories = Category::paginate(10);
        return view('category.show',compact('categories'));
    }

    public function create()
    {
        return view('category.add');
    }

    public function store(Request $request)
    {
        Category::create($request->all());
        flash()->overlay('Success', 'Category added successfully!');
        return view('category.add');
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('category.edit',compact('category'));
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('category.edit',compact('category'));
    }

    public function update(Request $request, $id)
    {
        $categories = Category::findOrFail($id);
        $categories->update($request->all());
        
        flash()->success('Success', 'Category updated successfully!');

        $categories = Category::all();

        return redirect('category')->with('categories');
    }

    public function destroy($id)
    {
        $delete = Category::findOrFail($id);

        $sub_category = Category::where('parent_id', '=', $id)->count();

        if ($sub_category > 0) {
            flash()->Overlay('Error', 'There are sub-categories under this parent category. Cannot delete this category until all sub-categories under this parent category are deleted');
        } 
        else {
            $delete->delete();
        }

        return redirect()->back();
    }

    public function addSubCategories($id) {

        $category = Category::findOrFail($id);

        return view('category.addsub', compact('category'));
    }


    public function addPostSubCategories($id, Request $request) {

        $category = Category::findOrFail($id);

        $subcategory = new Category($request->all());

        $category->children()->save($subcategory);
        $categories = Category::paginate(10);
        
        flash()->success('Success', 'Sub-Category added successfully!');
        
        return redirect()->route('category.show',compact('categories'));
    }


    public function editSubCategories($id) {
   
        $category = Category::where('id', '=', $id)->find($id);

        if (!$category) {
            return redirect('category');
        }

   
        return view('category.editsub', compact('category'));
    }

    public function updateSubCategories($id, Request $request) {

        $category = Category::findOrFail($id);

        $category->update($request->all());

        flash()->success('Success', 'Sub-Category updated successfully!');
        
        return redirect('category');
    }

    public function deleteSubCategories($id) {

        $delete_sub = Category::findOrFail($id);

        $products = Product::where('cat_id', '=', $id)->count();


        if ($products > 0) {
            flash()->customErrorOverlay('Error', 'There are products under this sub-category. Cannot delete this sub-category until all products under this sub-category are deleted');
        }  else {
            $delete_sub->delete();
        }

        return redirect()->back();
    }


    public function getProductsForSubCategory($id) {

        $categories = Category::where('id', '=', $id)->get();

        $products = Product::where('cat_id', '=', $id)->get();
    
        $count = Product::where('cat_id', '=', $id)->count();

        
        return view('category.show_products', compact('categories', 'products','count'));
    }

}
