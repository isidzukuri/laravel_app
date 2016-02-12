<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UniqueSeoNameModel;

class BlogTag extends Model
{
	use UniqueSeoNameModel;

	public $timestamps = false;
	
    protected $fillable = ['title', 'published'];

}