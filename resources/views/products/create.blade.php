@extends('layouts.app')

@section('content')

    <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-lg text-center">
            <h1 class="text-2xl font-bold sm:text-3xl">Cadastro de produto</h1>

        </div>
        <form method="POST" action="{{ route('products.store') }}" class="mx-auto mb-0 mt-8 max-w-md space-y-4">
            @csrf
            <div>
                <label for="name" class="sr-only">Nome Do Produto</label>
                <div class="relative">
                    <input
                        type="text"
                        name="name"
                        class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                        placeholder="Nome Do Produto"/>
                </div>
            </div>

            <div>
                <label for="price" class="sr-only">Preço</label>
                <div class="relative">
                    <input
                        name="price"
                        type="text"
                        class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                        placeholder="Preço"/>
                </div>
            </div>


            <div class="relative">
                <button
                    class="!absolute right-1 top-1 z-10 select-none rounded bg-pink-500 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-pink-500/20 transition-all hover:shadow-lg hover:shadow-pink-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none peer-placeholder-shown:pointer-events-none peer-placeholder-shown:bg-blue-gray-500 peer-placeholder-shown:opacity-50 peer-placeholder-shown:shadow-none"
                    type="button"
                    data-ripple-light="true"
                >
                    Upload
                </button>
                <input
                    name="img"
                    type="text"
                    class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm"
                    placeholder="Link da foto"
                    required
                />
            </div>

            <button
                type="submit"
                class="inline-block rounded-lg bg-blue-500 px-5 py-3 text-sm font-medium text-white"
            >
                Sign in
            </button>
        </form>
    </div>

@endsection
