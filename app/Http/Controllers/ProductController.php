<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController
{
    public function search($query)
    {
        try{
            $product = Product::where('name', 'like', '%' . $query . '%')->get();
            return response()->json($product, 200);
        }catch (\Exception $exception){
            return response()->json(['error' => $exception->getMessage()], 500);
        }

    }
    public function list()
    {
        try{
            return response()->json(Product::all(), 200);
        }catch (\Exception $exception){
            return response()->json(['error' => $exception->getMessage()], 500);
        }

    }

    public function store(Request $request){

        try{
            $data = $request->all();
            $product = new Product();
            $product->fill($data);
            if($product->save())
                return redirect()->route('products.index')->with('success', 'Produto criado com sucesso!');
        }catch (\Exception $exception){
            return response()->json(['error' => $exception->getMessage()], 500);
        }
        return response()->json('Erro ao criar produto', 500);
    }

    public function create(){

        return view('products.create');
    }

    public function index(){

        return view('products.index', ['products' => Product::all()->sortBy('name')]);

    }


}
