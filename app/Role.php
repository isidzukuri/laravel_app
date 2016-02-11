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
}
