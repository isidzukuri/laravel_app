<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UniqueSeoNameModel;
use App\Traits\MetaTagedModel;

class Post extends Model
{
	use UniqueSeoNameModel, MetaTagedModel;
	
    protected $fillable = ['title', 'text', 'user_id', 'description', 'published'];

    protected static function boot() {
        parent::boot();
        static::deleting(function($model) { 
             $model->meta_tag()->delete();
        });
    }

}