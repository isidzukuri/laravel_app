<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;

use App\Upload;
use File;
use Image;

class UploadController extends AdminController
{

    
    protected $controller_route_path = 'upload';


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $view = array(
            'items' => Upload::get_all_files_data()
            );
        return view("admin.{$this->controller_route_path}.all", $view);
    }


    public function upload_file(Request $request)
    {
        $file = $request->file('file');
        $ext = $file->getClientOriginalExtension();
        $original_name = str_replace(".{$ext}",'', $file->getClientOriginalName());
        $path = in_array($ext, ['jpg','png','gif']) ? "images/uploads/" : "files";
        $destination_path = public_path($path);
        $file_name = $original_name.'_'.str_random(8) . '.' . $ext;
        $file->move($destination_path, $file_name);
        return ['path' => $path, 'file_name' => $file_name];
    }

    
    public function create()
    {   
        return view("admin.{$this->controller_route_path}.form");
    }


    public function destroy(Request $request)
    {
        Upload::delete_file($request->input('path'));
    }

    


}
