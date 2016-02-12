<?php

namespace App\Http\Controllers\Admin;
use App\Post;
use App\Http\Requests\PostRequest;

class PostController extends AdminController
{

    protected $controller_route_path = 'post';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $view = array();
        $view['items'] = Post::orderBy('title','asc')->paginate(20);
        return view("admin.{$this->controller_route_path}.all", $view);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.{$this->controller_route_path}.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = $this->user->id;
        Post::create($input);
        $this->set_flash_message();
        return redirect($this->action_path);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view("admin.{$this->controller_route_path}.form", array('item' => Post::findOrFail($id)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $item = Post::findOrFail($id);
        $item->update($request->all());
        $this->set_flash_message();
        return redirect($this->action_path);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::destroy($id);
    }

}
