<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Category::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {        
        $validatedData = $request->validated();
        
        $request['slug'] = $this->createSlug($request['name']);
        $category = Category::create($request->all());
        
        return $category;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $term)
    {
        return Category::where('id',$term)
            ->orWhere('slug',$term)
            ->get();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $category = Category::find($id);
       
        if( !$category ){
            return response()->json([
                'message' => 'Category does not exist'
            ], 404);
        }

        $request['slug'] = $this->createSlug($request['name']);
        
        $category->update($request->all());
        

        // TODO: AGREGAR ACTUALIZACION DEL PROFILE 
        return response()->json($category, 200);
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
       
        if( !$category ){
            return response()->json([
                'message' => 'Category does not exist'
            ], 404);
        }

        $category->delete();
        return response()->json([
            'message' => 'Category delete'
        ], 404);
    }

    function createSlug($text) {
        $text = strtolower($text); // Convertir a minúsculas
        $text = preg_replace('/[^a-z0-9]+/', '_', $text); // Eliminar caracteres especiales
        $text = trim($text, '_'); // Eliminar guiones al inicio y al final
        $text = preg_replace('/_+/', '_', $text); // Reemplazar múltiples guiones por uno solo
    
        return $text;
    }


    
}
