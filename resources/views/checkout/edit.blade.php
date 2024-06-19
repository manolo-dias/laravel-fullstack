@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto mt-5">
        <h1 class="text-2xl font-bold mb-4">Editar Checkout</h1>
        <form action="{{ route('checkout.update', $checkout->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="customer_id" class="block text-sm font-medium text-gray-700">Cliente</label>
                <input type="text" name="customer_id" id="customer_id" value="{{ $checkout->customer->name }}"
                       class="w-full mt-1 rounded-md border-gray-300 shadow-sm">
            </div>
            <div class="mb-4">
                <label for="product_id" class="block text-sm font-medium text-gray-700">Produto</label>
                <input type="text" readonly value="{{ $checkout->product->name }}"
                       class="w-full mt-1 rounded-md border-gray-300 shadow-sm">
            </div>
            <div class="mb-4">
                <label for="product_id" class="block text-sm font-medium text-gray-700">Preço Unitário</label>
                <input type="text" readonly value="{{ $checkout->product->price }}"
                       class="w-full mt-1 rounded-md border-gray-300 shadow-sm">
            </div>
            <div class="mb-4">
                <label for="quantity" class="block text-sm font-medium text-gray-700">Quantidade</label>
                <input type="number" onchange="updateSubTotal(this,{{$checkout->product->price}})" name="quantity"
                       id="quantity" value="{{ $checkout->quantity }}"
                       class="w-full mt-1 rounded-md border-gray-300 shadow-sm">
            </div>
            <div class="mb-4">
                <label for="subtotal" class="block text-sm font-medium text-gray-700">Valor Total</label>
                <input type="number" readonly name="subtotal" id="subtotal"
                       value="{{ $checkout->quantity * $checkout->product->price }}"
                       class="w-full mt-1 rounded-md border-gray-300 shadow-sm">
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Salvar</button>
        </form>
    </div>
    <script>
        function updateSubTotal(input, price) {
            document.getElementById('subtotal').value = input.value * price
        }
    </script>
@endsection
