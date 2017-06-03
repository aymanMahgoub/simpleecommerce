<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\User;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(5);
        return view('home',compact('products'));
    }

    public function admin()
    {


        $this->middleware('auth');
        
        if(Auth::user()->rol==1){
        return view('Admin.index');
    
        }
        else{

        $products = Product::paginate(5);
        return view('home',compact('products'));
        }

    }
}
