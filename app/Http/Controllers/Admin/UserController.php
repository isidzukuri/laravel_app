<?php

namespace App\Http\Controllers\Admin;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;


class UserController extends AdminController
{

    protected $controller_route_path = 'user';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $view = array();
        $items = User::orderBy('email','asc');
        $view['items'] = $search ? $items->where('email','LIKE', "{$search}%")->paginate(1000) : $items->paginate(20);
        return view("admin.{$this->controller_route_path}.all", $view);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $view = array('roles' => Role::lists('title','id'));
        return view("admin.{$this->controller_route_path}.form", $view);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $input = $request->all();
        $item = User::create($input); 
        $roles_ids = isset($input['roles_list']) ? $input['roles_list'] : array();
        $item->sync_roles($roles_ids);
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
        $item = User::with('roles')->findOrFail($id);
        $view = array(
            'item' => $item,
            'roles' => Role::lists('title','id'),
            'roles_ids' => $item->roles->lists('id')->toArray()
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
    public function update(UserRequest $request, $id)
    {
        $input = $request->all();
        $item = User::findOrFail($id); 
        if($input['password'] == ''){
            unset($input['password']);
        }else{
            $input['password'] = bcrypt($input['password']);
        }
        $item->update($input);
        $roles_ids = isset($input['roles_list']) ? $input['roles_list'] : array();
        $item->sync_roles($roles_ids);
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
        User::destroy($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $word
     * @return json
     */
    public function autocomplete(string $word)
    {
        return User::where('email','LIKE', "{$word}%")->get(['id', 'email as title']);
    }


}
