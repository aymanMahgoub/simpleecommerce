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
            // Flash a error overlay message
            flash()->Overlay('Error', 'There are sub-categories under this parent category. Cannot delete this category until all sub-categories under this parent category are deleted');
        } 
         else {
            $delete->delete();
        }

        // Then redirect back.
        return redirect()->back();
    }

    public function addSubCategories($id) {

        $category = Category::findOrFail($id);

        // From Traits/CartTrait.php
        // ( Count how many items in Cart for signed in user )
        //$cart_count = $this->countProductsInCart();

        return view('category.addsub', compact('category'));
    }


    /**
     * Add a sub category to a parent category
     *
     * @param $id
     * @param CategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addPostSubCategories($id, Request $request) {

        // Find the Parent Category ID
        $category = Category::findOrFail($id);

        // Create the new Subcategory
        $subcategory = new Category($request->all());

        
            // Save the new subcategory into the relationship
        $category->children()->save($subcategory);
        $categories = Category::paginate(10);
            // Flash a success message
            flash()->success('Success', 'Sub-Category added successfully!');
        

        // Redirect back to Show all categories page.
        return redirect()->route('category.show',compact('categories'));
    }


    /**
     * Get the view ot edit a sub-category
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editSubCategories($id) {
        // Select all from categories where the id = the id on the page
        $category = Category::where('id', '=', $id)->find($id);

        // If no sub-category exists with that particular ID, then redirect back to Show Category Page.
        if (!$category) {
            return redirect('category');
        }

        // From Traits/CartTrait.php
        // ( Count how many items in Cart for signed in user )

        return view('category.editsub', compact('category'));
    }


    /**
     * Update a Sub-Category.
     *
     * @param $id
     * @param CategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateSubCategories($id, Request $request) {
        // Find the category id being updated
        $category = Category::findOrFail($id);

        
            // Update the category with all the validation rules from CategoryRequest.php
            $category->update($request->all());

            // Flash a success message
            flash()->success('Success', 'Sub-Category updated successfully!');
        

        // Redirect back to Show all categories page.
        return redirect('category');
    }

    /**
     * Delete a Sub-Category
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteSubCategories($id) {

        // Find the sub-category id and delete it from DB.
        $delete_sub = Category::findOrFail($id);

        // Get all sub categories where the parent_id = to the category id
        $products = Product::where('cat_id', '=', $id)->count();


        // If there are any sub-categories under a parent category, then throw
        // a error overlay message, saying to delete all sub categories under the parent
        // category, else delete the parent category
        if ($products > 0) {
            // Flash a error overlay message
            flash()->customErrorOverlay('Error', 'There are products under this sub-category. Cannot delete this sub-category until all products under this sub-category are deleted');
        }  else {
            $delete_sub->delete();
        }


        // Then redirect back.
        return redirect()->back();
    }


public function getProductsForSubCategory($id) {

        // Get the Category name under this category
        $categories = Category::where('id', '=', $id)->get();

        // Get all products under this sub-category
        $products = Product::where('cat_id', '=', $id)->get();

        // Count to see if there are any products under this category
        $count = Product::where('cat_id', '=', $id)->count();

        
        return view('category.show_products', compact('categories', 'products','count'));
    }

}
