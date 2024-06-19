@extends('layouts.app')

@section('content')
    <div class="relative">
        <label for="search" class="sr-only"> Pesquisar produto </label>

        <input
            type="text"
            id="search"
            placeholder="Digite o nome do produto"
            class="w-full rounded-md border-gray-200 py-2.5 pe-10 p-2.5 shadow-sm sm:text-sm"
        />

        <span class="absolute inset-y-0 right-0 flex items-center pr-3">
        <button type="button" class="text-gray-600 hover:text-gray-700">
            <span class="sr-only">Pesquisar produto</span>

            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="h-4 w-4"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"
                />
            </svg>
        </button>
    </span>
    </div>

    <a
        class="group flex items-center justify-between gap-4 rounded-lg mt-3 border border-current px-5 py-3 text-indigo-600 transition-colors hover:bg-indigo-600 focus:outline-none focus:ring active:bg-indigo-500"
        href="products/create"
    >
        <span class="font-medium transition-colors group-hover:text-white"> Cadastrar produto </span>

        <span
            class="shrink-0 rounded-full border border-indigo-600 bg-white p-2 group-active:border-indigo-500"
        >
    <svg
        class="size-5 rtl:rotate-180"
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
    >
      <path
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M17 8l4 4m0 0l-4 4m4-4H3"
      />
    </svg>
  </span>
    </a>


    <div class="bg-white mt-5">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <div class="flex flex-col items-center justify-center bg-gray-100 p-4 rounded-lg shadow-md">
                        <div class="aspect-w-1 aspect-h-1 mb-4 w-48">
                            <img src="{{ $product['img'] }}" alt="{{ $product['name'] }}" class="object-cover rounded-lg w-full h-full">
                        </div>
                        <div class="text-center">
                            <h3 class="text-sm font-medium text-gray-700 truncate w-32">{{ $product['name'] }}</h3>
                            <p class="text-sm text-gray-500">${{ $product['price'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
