<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::with(['category' ,'user' , 'comments'])->latest()->paginate();

        return view('admin.blogs.index' ,[
            'blogs' =>  $blogs ,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blogs.create' ,[
            'parents' =>  Category::where('parent_id' , '<>' , null)->get() ,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'title' =>  'required|string' ,
            'body'  =>  'required|string' ,
            'image' =>  'image' ,
            'parent'  =>  'required|exists:categories,id' ,

        ]);
        $image = '';
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $image_name = 'Blog-' . rand(100 , 50000) . '.' . $file->getClientOriginalExtension();
            $image = $file->storeAs('BlogImages' , $image_name , 'public');
        }
        $blog = new Blog();
        $blog->title = $request->post('title');
        $blog->body = $request->post('body');
        $blog->image = $image ;
        $blog->user_id = Auth::id() ;
        $blog->category_id = $request->post('parent');
        $blog->save();

        if($request->post('tags'))
        {
            $tag = new Tag();
            $tag->name = $request->post('tags');
            $tag->slug = Str::slug($tag->name);
            $tag->save();

            DB::table('blog_tag')->create([
                'blog_id'   =>  $blog->id ,
                'tag_id'    =>  $tag->id ,
            ]);
        }
        return redirect()->route('blogs.index')->with('success' , "Category $blog->name Updated Successfuly");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.blogs.show' ,[
            'blog' =>  Blog::findOrfail($id) ,
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
        return view('admin.blogs.edit' ,[
            'blog' =>  Blog::findOrfail($id) ,
        ]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
