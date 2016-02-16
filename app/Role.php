<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	public $timestamps = false;

    protected $fillable = ['title'];

    public function users()
    {
    	return $this->belongsToMany('App\User');
    }

    public function add_user($id)
    {
        return $this->users()->sync([$id]);
    }

    public function remove_user($id)
    {
        return $this->users()->detach($id);
    }

    public static function create_new_roles_if_exists(array $ids){
        foreach ($ids as $key => $id) {
            if(!is_numeric($id)) $ids[$key] = Role::create(['title' => $id])->id;
        }
        return $ids;
    }
}
