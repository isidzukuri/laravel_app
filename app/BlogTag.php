<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UniqueSeoNameModel;

class BlogTag extends Model
{
	use UniqueSeoNameModel;

	public $timestamps = false;
	
    protected $fillable = ['title', 'published'];

    public function posts(){
    	return $this->belongsToMany('App\Post');
    }

    public static function create_new_tags_if_exists(array $ids){
    	
    	foreach ($ids as $key => $id) {
    		if(!is_numeric($id)) $ids[$key] = BlogTag::create(['title' => $id])->id;
    	}
    	return $ids;
    }


}