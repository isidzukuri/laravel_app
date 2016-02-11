<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UniqueSeoNameModel;

class Page extends Model
{
	use UniqueSeoNameModel;

    protected $fillable = ['title', 'text'];
}
