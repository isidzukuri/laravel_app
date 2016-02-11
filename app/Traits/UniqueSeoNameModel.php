<?php

namespace App\Traits;

trait UniqueSeoNameModel{

	public function setTitleAttribute($value) {
    	$this->attributes['title'] = $value;
    	$seo = $this->create_seo_name($value);
		$this->attributes['seo'] = str_slug($seo);
	}

	public function create_seo_name($str){
		$seo = substr(str_slug($str), 0, 250);
		$same = $this->where('seo', $seo);
		if(isset($this->attributes['id'])) $same->where('id', '!=', $this->attributes['id']);
		if(!$same->get()->isEmpty()) $seo = $this->create_seo_name('1-'.$seo);
		return $seo;
	}
}