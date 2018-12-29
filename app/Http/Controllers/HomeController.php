<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductGroup;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($letter = 'a')
    {
        return view('dashboard');
    }


    public function create(){
      return view('admin.createOrEdit');
    }

    public function trash()
    {
        // return view('list');
    }

    public function logout(){
      \Auth::logout();
      return redirect(route('home'));
    }
}
