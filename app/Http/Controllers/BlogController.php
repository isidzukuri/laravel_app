<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Post;

class BlogController extends Controller
{
    
    public function show($seo)
    {
        $view = array();
        $view['item'] = Post::where('seo',$seo)->with('meta_tag', 'tags')->first();
        return view('site.blog.show', $view);
    }
}
