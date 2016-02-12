<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UniqueSeoNameModel;
use App\Traits\MetaTagedModel;

class Post extends Model
{
	use UniqueSeoNameModel, MetaTagedModel;
	
    protected $fillable = ['title', 'text', 'user_id', 'description', 'published'];

}