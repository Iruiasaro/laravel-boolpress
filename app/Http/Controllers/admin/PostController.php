<?php

namespace App\Http\Controllers\Admin;
use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Post $post)
    {
        $user=$post->user;

        $data = [
            'posts' => Post::orderBy("created_at", "DESC")
                ->where("user_id", $request->user()->id)
                ->get(),
                "user"=>$user];

        return view("admin.home", $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.create', ["categories" => $categories, "tags" => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newPostData = $request->all();

        $request->validate([
            "title"=> "required|max:100",
            "content"=> "required",
            'category_id' => "nullable|exists:categories,id",

        ]);

        $newPost = new Post();
        $newPost-> fill($newPostData);
        $newPost-> user_id=$request->user()->id;
        $newPost-> save();
        $newPost->tags()->attach($newPostData["tags"]);


        return redirect()-> route('admin.show',$newPost->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post, tag $tag)
    {
        //$singleUser = User::find($user);
        $user=$post->user;

        if(is_null($post)){
            abort(404);
        }
        
        return view('admin.show' , [
            "post" => $post,
            "user" =>$user,
            "tag" =>$tag

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $categories = Category::all();
        $tags = Tag::all();
        $post = Post::findOrFail($id);

        return view("admin.edit", [
            "post" => $post
        ],["categories" => $categories,"tags"=>$tags]);
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $formData = $request->all();

        $request->validate([
            "title"=> "required|max:255",
            "content"=> "required",
        ]);

        Storage::put("postCovers", $formData["postCover"]);

        $post->update($formData);

        return redirect()->route("admin.index", $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $post->delete();

        return redirect()->route("admin.index");
    }
}