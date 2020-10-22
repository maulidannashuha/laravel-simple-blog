<?php

namespace App\Http\Controllers;

use App\Business\CategoryBusiness;
use App\Business\PostBusiness;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with("category")->paginate(10);

        return view("pages.post.index", compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = PostBusiness::getAllCategories();
        $post = new Post();
        $action = route("posts.store");

        return view("pages.post.create", compact("categories", "post", "action"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $request["slug"] = Str::slug($request->title);

        PostBusiness::store($request->only(
            "title", "slug", "category_id", "content", "new_category"
        ));

        return redirect()->route("posts.index")->with("success", "Post created!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = PostBusiness::getAllCategories();
        $action = route("posts.update", $post->id);

        return view("pages.post.edit", compact("post", "categories", "action"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $request["slug"] = Str::slug($request->title);

        $data = $request->only(
            "title", "slug", "category_id", "content", "new_category"
        );

        PostBusiness::update($data, $id);

        return redirect()->route("posts.index")->with("success", "Post updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::destroy($id);

        return redirect()->route("posts.index")->with("success", "Post deleted!");
    }
}
