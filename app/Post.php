<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UniqueSeoNameModel;

class Post extends Model
{
	use UniqueSeoNameModel;
	
    protected $fillable = ['title', 'text', 'user_id', 'description', 'published'];
}