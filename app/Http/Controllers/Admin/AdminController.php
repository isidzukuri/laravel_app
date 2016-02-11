<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\OneValidation;

// use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
   
	protected $path_prefix = '/admin';

	protected $controller_route_path = '';

    public function __construct(){
    	$this->action_path = implode('/', array($this->path_prefix, $this->controller_route_path));
		view()->share('action_path', $this->action_path);
		view()->share('controller_route_path', $this->controller_route_path);
	}

	protected function set_flash_message($status = 'success', $message = 'Saved!'){
		session()->flash('flash_message', array('status' => $status,
                                                'message'=> $message));
	}

	// public function __destruct(){
 //     print_r(DB::getQueryLog());
 //    }
   
}
