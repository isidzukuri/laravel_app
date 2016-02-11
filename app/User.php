<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles(){
        return $this->belongsToMany('App\Role');
    }

    public function add_role($id){
        return $this->roles()->sync([$id]);
    }

    public function remove_role($id){
        return $this->roles()->detach($id);
    }

    public function has_role($title){
        return !$this->roles()->where('title',$title)->get()->isEmpty();
    }
}
