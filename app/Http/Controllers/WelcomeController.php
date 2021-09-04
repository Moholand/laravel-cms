<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index() 
    {

        // $search = request()->query('search');

        // if($search) {
        //     $posts = Post::where('title', 'LIKE', "%{$search}%")->simplePaginate(3);
        // } else {
        //     $posts = Post::simplePaginate(3);
        // }

        return view('welcome')
            ->with('categories', Category::all())
            ->with('tags', Tag::all())
            ->with('posts', Post::searched()->simplePaginate(3));
    } 
}
