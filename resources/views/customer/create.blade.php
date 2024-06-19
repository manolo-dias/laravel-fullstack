@extends('layouts.app')

@section('content')

    <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-lg text-center">
            <h1 class="text-2xl font-bold sm:text-3xl">Cadastro de clientes</h1>

        </div>
        <form method="POST" action="{{ route('customer.store') }}" class="mx-auto mb-0 mt-8 max-w-md space-y-4">
            @csrf
            <div>
                <label for="name" class="sr-only">Nome Do cliente</label>
                <div class="relative">
                    <input
                        type="text"
                        name="name"
                        class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                        placeholder="Nome Do Cliente"/>
                </div>
            </div>

            <div>
                <label for="cpf" class="sr-only">CPF</label>
                <div class="relative">
                    <input
                        name="cpf"
                        type="text"
                        class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                        placeholder="000.000.000-00"/>
                </div>
            </div>




            <button
                type="submit"
                class="inline-block rounded-lg bg-blue-500 px-5 py-3 text-sm font-medium text-white"
            >
                Cadastrar
            </button>
        </form>
    </div>

@endsection
