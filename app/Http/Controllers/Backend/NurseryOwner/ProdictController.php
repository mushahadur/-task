<?php

namespace App\Http\Controllers\Backend\NurseryOwner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\NurseryOwner\ProductRequest;
use App\Models\NurseryOwner\Product;

class ProdictController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->get();
        return view('backend.nursery-owner.pages.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.nursery-owner.pages.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $product = new Product();
        if ($request->hasFile('image')) {
            $destinationPath= 'public/product-images/';
            $image      = $request->file('image');
            $fileName   = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs($destinationPath,$fileName);
            $product->image = $fileName;
        }

        $product->name    = $request->name;
        $product->category   = $request->category;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->description = $request->description;
        $save = $product->save();
        if($save){
            return redirect(route('product.index'));
        }
        else{
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
