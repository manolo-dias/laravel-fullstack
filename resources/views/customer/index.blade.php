@extends('layouts.app')

@section('content')
    <script src="{{ asset('js/customer.js') }}"></script>

    <div class="relative">
        <label for="search-customer" class="sr-only"> Pesquisar cliente </label>

        <input
            type="text"
            id="search-customer"
            placeholder="Digite o nome do cliente"
            class="w-full rounded-md border-gray-200 py-2.5 pe-10 p-2.5 shadow-sm sm:text-sm"
            oninput="showCustomerDropdown(this.value)"
        />

        <span class="absolute inset-y-0 right-0 flex items-center pr-3">
        <button type="button" class="text-gray-600 hover:text-gray-700">
            <span class="sr-only">Pesquisar cliente</span>

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

        <ul id="customer-search-results" class="absolute z-10 w-full bg-white border border-gray-200 mt-1 rounded-md shadow-lg hidden">
        </ul>
    </div>

    <a
        class="group flex items-center justify-between gap-4 rounded-lg border border-current mt-3 px-5 py-3 text-indigo-600 transition-colors hover:bg-indigo-600 focus:outline-none focus:ring active:bg-indigo-500"
        href="customer/create"
    >
        <span class="font-medium transition-colors group-hover:text-white"> Cadastrar cliente </span>

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
@endsection
