<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\Post;
use App\Models\Video;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::query()
            ->select('id', 'title')
            ->with('images')
            ->with('categories')
            ->get();

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::query()->select('id', 'name')->get();
        return view('posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'category' => 'required',
            'image' => 'nullable',
            'video' => 'nullable'
        ]);

        $post = Post::query()->create([
            'user_id' => 1,
            'title' => $validated['title'],
            'body' => $validated['body'],
        ]);

        $post->categories()->attach([
            
        ])

        if($request->has('image')) {
            $post->images()->saveMany([
                new Image([
                    'seo_title' => '-',
                    'url' => $validated['image']->storeAs('images', $request->image->getClientOriginalName()),
                ])
            ]);
        }

        if($request->has('video')) {
            $post->videos()->saveMany([
                new Video([
                    'seo_title' => '-',
                    'url' => $validated['video']->storeAs('videos', $request->video->getClientOriginalName()),
                ])
            ]);
        }

        return redirect()->route('posts.index');
    }
}
