<?php

namespace App\Http\Controllers\Admin;
use App\Page;
use App\Http\Requests\PageRequest;


class PageController extends AdminController
{

    protected $controller_route_path = 'pages';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $view = array();
        $view['items'] = Page::orderBy('title','asc')->get();
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
    public function store(PageRequest $request)
    {
        $input = $request->all();
        Page::create($input);
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
        return view("admin.{$this->controller_route_path}.form", array('item' => Page::findOrFail($id)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request, $id)
    {
        $item = Page::findOrFail($id);
        $item->update($request->all());
        $this->set_flash_message();
        return redirect($this->action_path);;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Page::destroy($id);
    }

}
