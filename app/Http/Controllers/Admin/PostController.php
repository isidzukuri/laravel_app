<?php

namespace App\Http\Controllers\Admin;
use App\Post;
use App\BlogTag;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;


// use Storage;
// use ReflectionClass;
// use ReflectionMethod;
// use League\Flysystem\Adapter\Local;
use File;
use Image;

class PostController extends AdminController
{

    protected $controller_route_path = 'post';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $view = array();
        $items = Post::orderBy('title','asc');
        $view['items'] = $search ? $items->where('title','LIKE', "{$search}%")->paginate(1000) : $items->paginate(20);
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
        $item = $this->process_images($item, $input); 
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
        $item = $this->process_images($item, $input);        
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
        File::deleteDirectory(public_path("images/{$this->controller_route_path}/{$id}/"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $word
     * @return json
     */
    public function autocomplete(string $word)
    {
        return Post::where('title','LIKE', "{$word}%")->get(['id', 'title']);
    }


    protected function process_images($item, $input)
    {
        $item_path = public_path("images/{$this->controller_route_path}/{$item->id}/");
        if(isset($input['cropped_images']) && isset($input['cropped_images'][0])) {
            $image = $input['cropped_images'][0];
            $temp_path = public_path("images/{$this->controller_route_path}/temp/{$image}");
            $ext = File::extension($temp_path);
            $img_name = 'original.'.$ext;
            $this->add_directory_if_not_exist($item_path);
            File::move($temp_path, $item_path.$img_name);
            $item_fields = ['img_ext' => $ext];
        }
        if(isset($item_fields)) $item->update($item_fields);
        if(isset($input['cropped_coords']) && isset($input['cropped_coords'][0])) {
            $coords = json_decode($input['cropped_coords'][0]);
            $img_name = 'original.'.$item->img_ext;
            Image::make($item_path.$img_name)->crop((int) $coords->w, (int) $coords->h, (int) $coords->x, (int) $coords->y)->save($item_path.'cropped_'.$img_name);
        }
        return $item;
    }
    


    
}
