<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductCollection;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //? CREAR RESOURCES
        // return Product::all();
        return new ProductCollection(Product::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $request->validated();
        
        $request['slug'] = $this->createSlug($request['name']);
        $product = Product::create($request->all());
        return $product;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $term)
    {
        // ! Enseñar orWhere por si acaso
        return Product::where('id',$term)
        ->orWhere('slug',$term)
        ->get();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
       
        if( !$product ){
            return response()->json([
                'message' => 'Product does not exist'
            ], 404);
        }

        $request['slug'] = $this->createSlug($request['name']);
        
        $product->update($request->all());
        
        return response()->json($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
       
        if( !$product ){
            return response()->json([
                'message' => 'Product does not exist'
            ], 404);
        }

        $product->delete();
        return response()->json([
            'message' => 'Product delete'
        ], 200);
    }

    function createSlug($text) {
        $text = strtolower($text); // Convertir a minúsculas
        $text = preg_replace('/[^a-z0-9]+/', '_', $text); // Eliminar caracteres especiales
        $text = trim($text, '_'); // Eliminar guiones al inicio y al final
        $text = preg_replace('/_+/', '_', $text); // Reemplazar múltiples guiones por uno solo
    
        return $text;
    }
}
