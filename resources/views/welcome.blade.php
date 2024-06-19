@extends('layouts.app')

@section('content')
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="{{ asset('js/customer.js') }}"></script>
    <script src="{{ asset('js/product.js') }}"></script>


    <h1 class="text-3xl font-bold text-white text-center mb-4">Bem-vindo</h1>
    <p class="text-lg text-white text-center mb-8">Conheça nossas opções de parcelamento para facilitar suas
        compras.</p>

    <div class="bg-white rounded-lg shadow-md p-4">
        <form id="checkout-form" action="{{ route('checkout.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <div class="flex flex-wrap gap-2">


                    {{--                    cliente--}}
                    <div class="flex-column mr-4 w-full lg:w-fit">
                        <label for="search-customer"
                               class="block text-sm font-medium leading-6 text-gray-900">Clientes</label>
                        <div class="relative mt-2 rounded-md shadow-sm">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <span class="text-gray-500 sm:text-sm"></span>
                            </div>
                            <input type="text" name="customer" id="search-customer"
                                   class="block w-full rounded-md border-0 py-1.5 pl-3 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                   oninput="showCustomerDropdown(this.value)"
                                   onfocus="showCustomerDropdown(this.value)"
                                   placeholder="Digite o nome do cliente"
                                   autocomplete="off">
                            <ul id="customer-search-results"
                                class="absolute z-10 w-full bg-white border border-gray-200 mt-1 rounded-md shadow-lg hidden">
                            </ul>
                        </div>

                    </div>

                    <input type="text" hidden name="customer_id" id="customer_id">
                    <input type="text" hidden name="product_id" id="product_id">

                    {{--                    produto--}}
                    <div class="flex-column mr-4 w-full lg:w-fit">
                        <label for="search-product"
                               class="block text-sm font-medium leading-6 text-gray-900">Produtos</label>
                        <div class="relative mt-2 rounded-md shadow-sm">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <span class="text-gray-500 sm:text-sm"></span>
                            </div>
                            <input type="text" name="product" id="search-product"
                                   class="block w-full rounded-md border-0 py-1.5 pl-3 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                   oninput="showProductDropdown(this.value)"
                                   placeholder="Digite o produto"
                                   autocomplete="off">
                            <ul id="product-search-results"
                                class="absolute z-10 w-full bg-white border border-gray-200 mt-1 rounded-md shadow-lg hidden">
                            </ul>
                        </div>
                    </div>

                    {{--                    Quantidade--}}
                    <div class="flex-column mr-4">
                        <label for="qtd"
                               class="block text-sm font-medium leading-6 text-gray-900">Quantidade</label>
                        <div class="relative mt-2 rounded-md shadow-sm">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <span class="text-gray-500 sm:text-sm"></span>
                            </div>
                            <input type="number" name="quantity" id="qtd"
                                   class=" block w-20 rounded-md border-0 py-1.5 pl-3 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                   placeholder="">
                        </div>
                    </div>

                    {{--                    Valor Unitario--}}
                    <div class="flex-column mr-4">
                        <label for="unitvalue" class="block text-sm font-medium leading-6 text-gray-900">Valor
                            Unitario</label>
                        <div class="relative mt-2 rounded-md shadow-sm">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <span class="text-gray-500 sm:text-sm"></span>
                            </div>
                            <input type="number" name="unitvalue" id="unitvalue"
                                   class="block w-24 rounded-md border-0 py-1.5 pl-3 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                   placeholder="" readonly>
                        </div>
                    </div>

                    {{--                    SubTotal--}}
                    <div class="flex-column mr-4">
                        <label for="subtotal" class="block text-sm font-medium leading-6 text-gray-900">SubTotal</label>
                        <div class="relative mt-2 rounded-md shadow-sm">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <span class="text-gray-500 sm:text-sm"></span>
                            </div>
                            <input type="number" name="subtotal" id="subtotal"
                                   class="block w-28 rounded-md border-0 py-1.5 pl-3 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                   placeholder="" readonly>
                        </div>
                    </div>

                    <button type="button" class="bg-blue-500 text-white  px-4 py-2 rounded" onclick="handleAddItemCart()">
                        Adicionar Item
                    </button>
                </div>
            </div>

            <div id="cartPreview">


            </div>
            <div class="text-center ">
                <button type="button" id="openPopup" onclick="addProduct()"
                        class="w-full lg:w-fit inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Enviar
                </button>

                <div id="popup" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
                    <div class="bg-white p-8 rounded h-[80vh] overflow-y-auto shadow-lg w-2/3">
                        <h2 class="text-2xl mb-4">Entre com o numero de parcelas</h2>
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center mt-5 rounded border border-gray-200">
                                <button type="button" id="remove-product" class="size-10 leading-10 text-gray-600 transition hover:opacity-75">
                                    &minus;
                                </button>

                                <input
                                    type="number"
                                    id="quantity"
                                    value="0"
                                    readonly
                                    class="h-10 w-16 border-transparent text-center [-moz-appearance:_textfield] sm:text-sm [&::-webkit-inner-spin-button]:m-0 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:m-0 [&::-webkit-outer-spin-button]:appearance-none"
                                />

                                <button type="button" id="add-product" class="size-10 leading-10 text-gray-600 transition hover:opacity-75">
                                    &plus;
                                </button>
                            </div>

                            <div class="w-28">
                                <label class="block text-sm font-medium leading-6 text-gray-900">SubTotal</label>
                                <input type="text" id="showSubTotal"
                                       class="subtotal block w-full rounded-md border-0 py-1.5 pl-3 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                       placeholder="" readonly>
                            </div>
                        </div>
                        <div id="cart" class="bg-white rounded-lg shadow-md p-4">

                            <div id="product-container">

                            </div>
                        </div>

                    </div>


                    <script type="text/template" id="product-template">
                        <div
                            class="product-row flex flex-wrap items-center justify-between bg-white border border-gray-200 p-4 rounded-md mb-2">
                            <div class="w-full lg:w-fit mr-4">
                                <label class="block text-sm font-medium leading-6 text-gray-900">Parcela</label>
                                <input type="text" readonly
                                       class="parcela block w-full rounded-md border-0 py-1.5 pl-3 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                       placeholder="R$ 1500" autocomplete="off">
                            </div>
                            <div class="w-full lg:w-fit mr-4">
                                <label class="block text-sm font-medium leading-6 text-gray-900">Vencimento</label>
                                <input type="date" readonly
                                       class="date block w-full rounded-md border-0 py-1.5 pl-3 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                       placeholder="" autocomplete="off">
                            </div>

                            <div class="w-fit mr-4">
                                <label class="block text-sm font-medium leading-6 text-gray-900">Pagamento</label>
                                <select class="payment-method block w-36 rounded-md border-0 py-1.5 pl-3 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <option value="30days">30 Dias</option>
                                    <option value="custom">Personalizado</option>
                                </select>
                            </div>
                            <button class="remove bg-red-500 text-white px-4 py-2 rounded">Remover</button>
                        </div>
                        <button id="closePopup" type="submit" class="bg-blue-500 text-white w-fit px-4 py-2 rounded">Enviar
                        </button>
                    </script>



                </div>
            </div>
        </form>
    </div>
@endsection
