@extends('layouts.app')

@section('content')
    <div class="bg-white mt-5">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-700">Cliente</th>
                        <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-700">Valor do Produto</th>
                        <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-700">Quantidade</th>
                        <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-700">Valor Total</th>
                        <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-700">Hora do Pedido</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($checkouts as $checkout)
                        <tr>
                            <td class="py-2 px-4 border-b text-sm text-gray-500">{{ $checkout->customer->name }}</td>
                            <td class="py-2 px-4 border-b text-sm text-gray-500">{{ $checkout->product->price }}</td>
                            <td class="py-2 px-4 border-b text-sm text-gray-500">{{ $checkout->quantity }}</td>
                            <td class="py-2 px-4 border-b text-sm text-gray-500">{{ $checkout->quantity * $checkout->product->price }}</td>
                            <td class="py-2 px-4 border-b text-sm text-gray-500">{{ $checkout->created_at->format('H:i:s') }}</td>
                            <td class="py-2 px-4 border-b text-sm text-gray-500">
                                <a href="{{ route('checkout.edit', $checkout->id) }}" class="text-blue-500 hover:underline">Editar</a>
                                <form action="{{ route('checkout.destroy', $checkout->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Tem certeza que deseja excluir este registro?')">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
