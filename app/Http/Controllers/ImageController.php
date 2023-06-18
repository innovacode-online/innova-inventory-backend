<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        
        // TODO?: SUBIDA DE IMAGEN
        //? Correr -> php artisan storage:link
        $file = $request->file('image');
        $name = $file->getClientOriginalName();
        $path = $request->image->storeAs('public/products', $name);        
        
        return Storage::url($path);
    }

}
