<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('status', 'published')
                     ->latest('published_at')
                     ->paginate(9);

        return view('posts.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)
                    ->where('status', 'published')
                    ->firstOrFail();

        $relatedPosts = Post::where('status', 'published')
                            ->where('id', '!=', $post->id)
                            ->latest()
                            ->take(3)
                            ->get();

        return view('posts.show', compact('post', 'relatedPosts'));
    }
}