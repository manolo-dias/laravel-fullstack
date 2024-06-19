<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use Illuminate\Http\Request;

class CheckoutController
{
    public function store(Request $request){
        try{
            $data = $request->all();
            Checkout::create($data);
            return redirect()->route('checkout.index')->with('success', 'Checkout criado com sucesso!');
        }catch (\Exception $exception){
            return redirect()->route('checkout.index')->with('erro', 'Erro ao criar o checkout!');

        }

    }

    public function update(Request $request, $id)
    {
        $checkout = Checkout::findOrFail($id);
        $checkout->quantity = $request->quantity;
        $checkout->save();

        return redirect()->route('checkout.index')->with('success', 'Checkout atualizado com sucesso!');
    }

    public function index(){
        return view('checkout.index', ['checkouts' => Checkout::all()]);
    }

    public function edit($id)
    {
        $checkout = Checkout::findOrFail($id);
        return view('checkout.edit', compact('checkout'));
    }

    public function destroy($id){
        try{
            Checkout::findOrFail($id)->delete();
            return redirect()->route('checkout.index')->with('success', 'Checkout excluído com sucesso!');
        }catch (\Exception $exception){
            return redirect()->route('checkout.index')->with('error', 'Falha ao excluir item!');

        }
    }
}
