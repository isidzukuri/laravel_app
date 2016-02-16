<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UniqueSeoNameModel;
use App\Traits\MetaTagedModel;

class Post extends Model
{
	use UniqueSeoNameModel, MetaTagedModel;
	
    protected $fillable = ['title', 'text', 'user_id', 'description', 'published', 'img_ext'];

    protected static function boot() {
        parent::boot();
        static::deleting(function($model) { 
             $model->meta_tag()->delete();
        });
    }

    public function tags(){
        return $this->belongsToMany('App\BlogTag');
    }

    public function sync_tags(array $ids){
    	$ids = BlogTag::create_new_tags_if_exists($ids);
        return $this->tags()->sync($ids);
    }

    public static function get_few($limit = 3){
        return Post::where('published',1)->orderBy('id','desc')->take($limit)->select('id','title','img_ext','description','seo')->get();
    }
}