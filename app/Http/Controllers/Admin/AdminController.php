<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\One;
use App\Http\Requests\OneValidation;

// use Illuminate\Support\Facades\DB;

// use Gate;

class AdminController extends Controller
{
   
    // public function __destruct(){
    //  print_r(DB::getQueryLog());
    // }


    public function index(){
    	// Gate::denies('loged_user');
    	One::all();
    	// die('lol');
    }


   
}
