<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->get();
        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.create');
    }
    
    /**
     * Create Clone Post Functionality
    */

    public function storeClone(Request $request, Post $post)
    {
        $clonedPost = $post->replicate();
        $clonedPost->title = $request->input('title', $post->title . ' (Clone)');
        $clonedPost->user_id = auth()->id(); // Set the user_id to the logged in user
        $clonedPost->save();

        return redirect()->route('posts.index');
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
            'user_id' => 'nullable|integer' //will be set to logged in user id
        ]);
        // Set the user_id to the logged in user
        $data['user_id'] = auth()->id();


        if ($request->hasFile('image')) {
            // delete old image
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $data['image'] = $request->file('image')->store('posts', 'public');
           //dd($request);
        }
        $post->update($data);
        return redirect()->route('posts.index');
    }
 
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
            'user_id' => 'nullable|integer' //will be set to logged in user id
        ]);
        $data['user_id'] = auth()->id();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('posts', 'public');
        }
        Post::create($data);
        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        $post->delete();
        return redirect()->route('posts.index');
    }
}
