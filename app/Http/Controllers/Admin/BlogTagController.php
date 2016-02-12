<?php

namespace App\Http\Controllers\Admin;
use App\BlogTag;
use App\Http\Requests\BlogTagRequest;


class BlogTagController extends AdminController
{

    protected $controller_route_path = 'blog_tag';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $view = array();
        $view['items'] = BlogTag::orderBy('title','asc')->paginate(20);
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
    public function store(BlogTagRequest $request)
    {
        $input = $request->all();
        $item = BlogTag::create($input);
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
        return view("admin.{$this->controller_route_path}.form", array('item' => BlogTag::findOrFail($id)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogTagRequest $request, $id)
    {
        $input = $request->all();
        $item = BlogTag::findOrFail($id);
        $item->update($input);
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
        BlogTag::destroy($id);
    }

}
