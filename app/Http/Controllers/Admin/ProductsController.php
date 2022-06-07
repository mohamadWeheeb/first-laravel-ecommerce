<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.products.index' ,[
            'products' =>  Product::paginate() ,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create' ,[
            'categories' =>  Category::all() ,
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
            'name'  =>  'required|string|unique:products,name' ,
            'description'   =>  'nullable|string' ,
            'price' =>  'required|numeric' ,
            'discount'  =>  'nullable|numeric' ,
            'quantity'  =>  'required|integer' ,
            'category_id'   =>  'required|exists:categories,id' ,
            'image'         =>  'image' ,

        ]);

        $image = '';
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $image_path = 'Product-'. rand(0,100000) . '.' . $file->getClientOriginalExtension();
            $image = $file->storeAs('Productsimage' , $image_path , 'public');
        }
        $product = new Product();
        $product->name = $request->post('name');
        $product->description = $request->post('description');
        $product->price = $request->post('price');
        $product->discount = $request->post('discount');
        $product->quantity = $request->post('quantity');
        $product->user_id = Auth::id();
        $product->slug = Str::slug($product->name);
        $product->category_id = $request->post('category_id');
        $product->image = $image ;
        $product->save();
        return redirect()->route('products.index')->with('success' , "Product $product->name Added Successfuly");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.products.show' ,[
            'product' =>  Product::findOrfail($id) ,
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
        return view('admin.products.edit' ,[
            'product' =>  Product::findOrfail($id) ,
            'categories'    =>  Category::all() ,
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
        $product =  Product::findOrfail($id);
        $request->validate([
            'name'  =>  'required|string|unique:products,name,' . $product->id ,
            'description'   =>  'nullable|string' ,
            'price' =>  'required|numeric' ,
            'discount'  =>  'nullable|numeric' ,
            'quantity'  =>  'required|integer' ,
            'category_id'   =>  'required|exists:categories,id' ,
            'image'         =>  'image' ,

        ]);

        $image = $product->image;
        $prevouseImage = '';
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $image_path = 'Product-'. rand(0,100000) . '.' . $file->getClientOriginalExtension();
            $image = $file->storeAs('Productsimage' , $image_path , 'public');
            $prevouseImage = $product->image;
        }
        $product->name = $request->post('name');
        $product->description = $request->post('description');
        $product->price = $request->post('price');
        $product->discount = $request->post('discount');
        $product->quantity = $request->post('quantity');
        $product->category_id = $request->post('category_id');
        $product->image = $image ;
        $product->update();
        if($prevouseImage)
        {
            Storage::disk('public')->delete($prevouseImage);
        }
        return redirect()->route('products.index')->with('success' , "Product $product->name Updated Successfuly");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product =  Product::findOrfail($id);
        $product->delete();
        if($product->image)
        {
            Storage::disk('public')->delete($$product->image);
        }
        return redirect()->route('products.index')->with('success' , "Product $product->name Deleted Successfuly");
    }
}
