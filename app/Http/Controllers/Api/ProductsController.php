<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
class ProductsController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->limit(10)->get();
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  =>  'required' ,
            'category_id' =>    'required|exists:categories,id' ,
            'price'     =>  'required|numeric' ,
            'user_id'  =>  'required|exists:users,id' ,
        ]);

        $name = $request->post('name');
        $product = new Product();
        $product->name = $name;
        $product->category_id = $request->post('category_id');
        $product->price = $request->post('price');
        $product->user_id = $request->post('user_id');
        $product->slug = Str::slug($name);
        $product->description = $request->post('description');
        $product->quantity = $request->post('quantity');
        $product->discount = $request->post('discount');
        $product->save();
        return $product;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrfail($id);

        return response()->json($product);
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
        $product = Product::findOrfail($id);
        $request->validate([
            'name'  =>  'sometimes|required' ,
            'category_id' =>    'sometimes|required|exists:categories,id' ,
            'price'     =>  'sometimes|required|numeric' ,
            'user_id'  =>  'sometimes|required|exists:users,id' ,
        ]);

        $product->update($request->all());
        return Response::json([
            'message'   =>  'Product Updated' ,
            'date'      =>  $product ,

        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrfail($id);
        $product->delete();
        return Response::json([
            "message" => "product $product->name Deleted" ,

        ]);
    }
}
