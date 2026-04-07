<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->get();
        return view('posts.index', compact('posts'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();
        Post::create($validated);
        return redirect()->route('home')->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post, $id)
    {
        $post_details = $post::with('comments')->find($id);
        return view('posts.show', compact('post_details'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post, $id)
    {
        $edit_post = $post->find($id);
        return view('posts.edit', compact('edit_post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post, $id)
    {
        $post = $post->find($id);
        $post->update($request->validated());
        return redirect()->route('home')->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post, $id)
    {
        $post = $post->find($id);
        $post->delete();
        return redirect()->route('home')->with('success', 'Post deleted successfully.');     
    }
}