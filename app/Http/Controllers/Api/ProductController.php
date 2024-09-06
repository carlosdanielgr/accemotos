<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function newProduct(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'quantity' => 'required',
            'type' => 'required',
            'code' => 'required',
            'price' => 'required',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->quantity = $request->quantity;
        $product->type = $request->type;
        $product->code = $request->code;
        $product->price = $request->price;
        $product->save();
        return response("¡Producto creado con éxito!", Response::HTTP_CREATED);
    }

    public function newPurchase(Request $request, $id)
    {
        $user = User::find($id);
        foreach ($request->data as $idProduct) {
            $product = Product::find($idProduct);
            if ($product && $product->quantity > 0) {
                $user->products()->attach($product->id);
            }
        };
        return response("Producto disponible agregado al usuario");
    }
}
