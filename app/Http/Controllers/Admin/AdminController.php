<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\OneValidation;
use Illuminate\Support\Facades\Auth;
use File;

use Illuminate\Support\Facades\DB;



class AdminController extends Controller
{
   
	protected $path_prefix = '/admin';

	protected $controller_route_path = '';

	protected $user;

    public function __construct(){
    	$this->action_path = implode('/', array($this->path_prefix, $this->controller_route_path));
		view()->share('action_path', $this->action_path);
		view()->share('controller_route_path', $this->controller_route_path);
		$this->user = Auth::user();
	}

	protected function set_flash_message($message = false, $status = 'success'){
		if(!$message) $message = trans('model.saved');
		session()->flash('flash_message', array('status' => $status,
                                                'message'=> $message));
	}

	public function add_directory_if_not_exist($directory) {
	    if (!File::exists($directory)) {
	        File::makeDirectory($directory, 0777, true);
	    }
	}

	public function upload_img_file(Request $request)
    {
        $file = $request->file('file');
        $url_path = "images/{$this->controller_route_path}/temp/";
        $destination_path = public_path($url_path);
        $file_name = str_random(15) . '.' . $file->getClientOriginalExtension();
        $file->move($destination_path, $file_name);
        return ['path' => $url_path, 'file_name' => $file_name];
    }

	// public function __destruct(){
 //     print_r(DB::getQueryLog());
 //     	// view()->share('db_query_log', DB::getQueryLog());
 //    }
   
}
