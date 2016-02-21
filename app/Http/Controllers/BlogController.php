<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Post;

class BlogController extends Controller
{
    
    public function index()
    {
        $view = array();
        $view['items'] = Post::get_all_paginator();
        return view('site.blog.index', $view);
    }

    public function show($seo)
    {
        $view = array();
        $view['item'] = Post::where('seo',$seo)->with('meta_tag', 'tags')->first();
        return view('site.blog.show', $view);
    }


    public function tag($seo)
    {
        $view = array();
        $view['items'] = Post::get_by_tag_paginator($seo);
        return view('site.blog.tag', $view);
    }
}
