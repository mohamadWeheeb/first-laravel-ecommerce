<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class CategoriesController extends Controller
{


    public function __construct()
    {
        // $this->authorizeResource(Category::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $this->authorize('view-any' , Category::class);
        $categories = Category::paginate();
        return view('admin.categories.index' ,[
            'categories' =>  $categories ,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create' , Category::class);
        return view('admin.categories.create' ,[
            'parents'   =>  Category::all() ,
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
        $this->authorize('create' , Category::class);
        $request->validate(
            [
                'name'  =>  'required|string|unique:categories,name' ,
                'description'   =>  'nullable|string' ,
                'parent'    =>  'nullable|existe:categories,id' ,
                'image'     =>  'nullable|image|mimes:jpeg,png,jpg,gif' ,
                'status'    =>  'required|in:active,draft' ,
            ]
        );

        $image = '';
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $image_path = 'Category-'. rand(0,100000) . '.' . $file->getClientOriginalExtension();
            $image = $file->storeAs('Categoriesimage' , $image_path , 'public');
        }

        $category = new Category();
        $category->name = $request->post('name');
        $category->description = $request->post('description');
        $category->parent_id = $request->post('parent');
        $category->slug = Str::slug($request->post('name'));
        $category->status   =   $request->post('status');
        $category->user_id  =   Auth::id();
        $category->image = $image;
        $category->save();
        return redirect()->route('categories.index')->with('success' , "Category $category->name Added Successfuly");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category =Category::findOrfail($id);
        $this->authorize('view' , $category);
        return view('admin.categories.show' ,[
            'category'  =>  $category ,
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
        $category =Category::findOrfail($id);
        $this->authorize('update' , $category);
        return view('admin.categories.edit' ,[
            'parents'   =>  Category::all() ,
            'category'  =>  $category ,
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
        $category =Category::findOrfail($id);
        $this->authorize('update' , $category);
        $this->authorize('view' , $category);
        $request->validate(
            [
                'name'  =>  'required|string|unique:categories,name,' . $category->id ,
                'description'   =>  'nullable|string' ,
                'parent'    =>  'nullable|existe:categories,id' ,
                'image'     =>  'nullable|image|mimes:jpeg,png,jpg,gif' ,
                'status'    =>  'required|in:active,draft' ,
            ]
        );

        $previousImage = null;
        $image=$category->image;
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $image_path = 'Category-'. rand(0,100000) . '.' . $file->getClientOriginalExtension();
            $image = $file->storeAs('Categoriesimage' , $image_path , 'public');
            $previousImage = $category->image;
        }

        $category->name = $request->post('name');
        $category->description = $request->post('description');
        $category->parent_id = $request->post('parent');
        $category->slug = Str::slug($request->post('name'));
        $category->status   =   $request->post('status');
        $category->user_id  =   Auth::id();
        $category->image = $image;
        $category->update();
        if($previousImage)
        {
            Storage::disk('public')->delete($previousImage);
        }
        return redirect()->route('categories.index')->with('success' , "Category $category->name Updated Successfuly");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category =Category::findOrfail($id);
        $this->authorize('delete' , $category);
        $category->delete();

        if($category->image)
        {
            Storage::disk('public')->delete($category->image);
        }
        return redirect()->route('categories.index')->with('success' , "Category $category->name Deleted Successfuly");
    }
}
