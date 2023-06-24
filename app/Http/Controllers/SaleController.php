<?php

namespace App\Http\Controllers;

use App\Http\Resources\SaleCollection;
use App\Http\Resources\SaleResource;
use App\Models\Product;
use App\Models\ProductSale;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new SaleCollection(
            Sale::with('products')->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //? GUARDAR PEDIDO
        $sale = new Sale;
        $sale->client = $request->client;
        $sale->total = $request->total;
        $sale->save();
        $id = $sale['id'];

        //? OBTENER EL ARREGLO DE PRODUCTOS
        $products = $request->products;
        $product_sale = [];

        //? ITERAR EN EL ARREGLO PARA INSERTAR EL ID DE LA VENTA
        foreach ($products as $product) {
            $product_sale[] = [
                'sale_id' => $id, 
                'product_id' => $product['id'],
                'amount' => $product['amount'],
                'created_At' => Carbon::now(),
                'updated_At' => Carbon::now()
            ];

            //? ACTUALIZAR STOCK DEL PRODUCTO
            $productUpdated = Product::find($product['id']);
            if( $product['amount'] > $productUpdated['stock'] )
            {
                return response(['message' => 'No hay suficiente stock'], 400);
            }

            $productUpdated['stock'] = $productUpdated['stock'] - $product['amount'];
            $productUpdated->update();
        }

        ProductSale::insert($product_sale);

        return response(['message' => 'Venta realizada exitosamente'], 200);
    }
}
