<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetaTag extends Model
{
	public $timestamps = false;
	
    protected $fillable = ['title', 'meta_title', 'meta_description', 'meta_keywords', 'type', 'obj_id'];

    public function obj()
    {
        return $this->morphTo();
    }
}
