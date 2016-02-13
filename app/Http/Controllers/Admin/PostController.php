<?php

namespace App\Http\Controllers\Admin;
use App\Post;
use App\BlogTag;
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
        $view = array('tags' => BlogTag::where('published',1)->lists('title','id'));
        return view("admin.{$this->controller_route_path}.form", $view);
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
        $item = Post::create($input);
        $item->meta_tag()->create($input);
        $tags_ids = isset($input['tags_list']) ? $input['tags_list'] : array();
        $item->sync_tags($tags_ids);
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
        $item = Post::with('meta_tag', 'tags')->findOrFail($id);
        $view = array(
            'item' =>$item,
            'tags' => BlogTag::where('published',1)->lists('title','id'),
            'tags_ids' => $item->tags->lists('id')->toArray()
            );
        return view("admin.{$this->controller_route_path}.form", $view);
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
        $input = $request->all();
        $item = Post::findOrFail($id);
        $item->update($input);
        $item->meta_tag->update($input);
        $tags_ids = isset($input['tags_list']) ? $input['tags_list'] : array();
        $item->sync_tags($tags_ids);
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
