<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\One;
use App\Http\Requests\OneValidation;
// use Illuminate\Support\Facades\DB;

class OneController extends Controller
{

	// public function __destruct(){
	// 	print_r(DB::getQueryLog());
	// }


    public function one(){
    	$view = array();
    	$view['name'] = 'Ross'; 
    	$view['user_data'] = array(
    		'awesomeness' => 5,
    		'power' => 'ultimate'
    		); 
    	return view('one.one', $view);
    }


    public function all_json(){
    	return One::all();
    }


    public function getSome(){

    	dd('$id');
    }


    public function index(){
    	$view = array();
    	$view['items'] = One::orderBy('awesomeness','desc')->get();
    	return view('one.all', $view);
    }


    public function show($id){
    	$view = array('item' => One::findOrFail($id)->toArray());
    	return view('one.show', $view);
    }

    public function create(){
    	return view('one.form');
    }

    public function edit($id){
    	return view('one.form', array('item' => One::findOrFail($id)));
    }

    public function update($id, OneValidation $request){
    	$item = One::findOrFail($id);
    	$item->update($request->all());
    	return redirect('/one');
    }

    public function store(OneValidation $request){
    	$input = $request->all();
    	One::create($input);
    	session()->flash('flash_message', 'The new One is with us now!');
    	return redirect('/one');
    }
}
