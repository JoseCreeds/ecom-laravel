<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'libelle' => 'required|string|unique:products,libelle',
            'description' => 'required|string',
            'picture' => 'required|string',
            'price' => 'required'
        ]);

        $product = Product::create($request->all());

        return abort(200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Product::findOrfail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $product = Product::findOrfail($id);
        $request->validate([
            'libelle' => 'required|string',
            'description' => 'required|string',
            'picture' => 'required|string',
            'price' => 'required'
        ]);
        $product->update([
            'libelle' => $request['libelle'],
            'description' => $request['description'],
            'picture' => $request['picture'],
            'price' => $request['price'],
        ]);

        return $product;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        return Product::destroy($id);
    }

    /**
     *Search for a name.
     */
    public function search(string $name)
    {
        return Product::where('libelle', 'like', '%' . $name . '%')->get();
    }
}
