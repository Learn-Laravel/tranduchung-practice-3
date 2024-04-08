<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->posts = new Post;
    }
    private $posts;
    public function index()
    {
      $posts = $this -> posts ->getAllPosts();
      return response() ->json($posts); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataInsert = [
            'name' => $request->name,
            'description' =>$request->description
        ];
        $this->posts->createPost($dataInsert);
        return response()->json(['message' => 'Post created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        try {
            $post = $this->posts->getOnePost($id);
            return response()->json(['post' => $post]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Post not found'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = $this->posts->getOnePost($id);
        $dataUpdate = [
            'name' => $request->name,
            'description' =>$request->description
        ];
        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }
        $this->posts->updatePost($dataUpdate, $id);
        return response()->json(['message' => 'Post updated successfully'], 201);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = $this->posts->getOnePost($id);
        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }
        $this->posts->deletePost($id);
        return response()->json(['message' => 'Post deleted successfully'], 200);
    }
}
