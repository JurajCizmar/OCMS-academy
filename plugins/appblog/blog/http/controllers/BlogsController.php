<?php namespace AppBlog\Blog\Http\Controllers;

use AppBlog\Blog\Models\Blog;
use AppBlog\Blog\Http\Resources\BlogResource;
use Illuminate\Routing\Controller;

class BlogsController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        return BlogResource::collection($blogs);
    }

    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        return BlogResource::make($blog);
    }
}