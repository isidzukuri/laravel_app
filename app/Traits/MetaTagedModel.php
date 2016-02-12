<?php

namespace App\Traits;

trait MetaTagedModel{

	public function meta_tag()
    {
        return $this->morphOne('App\MetaTag', 'obj');
    }
}