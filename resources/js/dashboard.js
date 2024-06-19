document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('search-product').onclick = function () {
        fetch('/products/list')
            .then(async response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return await response.json();
            })
            .then(data => {
                console.log(data);
            })
    }
})

const renderCartPreview = () => {
    const cartPreview = document.getElementById("cartPreview");
    cartPreview.innerHTML = '';
    const products = CartHook.getProducts();
    let productHTML = '';
    products.forEach(product => {
        console.log(product)
        productHTML += createProductTemplate(product.customerName, product.productName, product.quantity, product.price, product.subtotal);
    })
    cartPreview.innerHTML = productHTML
}
document.addEventListener('DOMContentLoaded', function () {
    renderCartPreview()
})

const handleAddItemCart = () => {
    const customerName = document.getElementById("search-customer").value
    const productName = document.getElementById("search-product").value
    const quantity = document.getElementById("qtd").value
    const price = document.getElementById("unitvalue").value
    const subtotal = document.getElementById("subtotal").value
    CartHook.addProduct({
        price,
        customerName,
        productName,
        quantity,
        subtotal
    });
    renderCartPreview();
}
window.handleAddItemCart = handleAddItemCart


const CartHook = (() => {
    const CART_KEY = 'shoppingCart';

    const getSubTotal = () => {
        let total = 0;
        getProducts().forEach(item => {
            total += item.quantity * item.price;
        });
        return total.toFixed(2);
    }

    const getCart = () => {
        const cart = localStorage.getItem(CART_KEY);
        return cart ? JSON.parse(cart) : [];
    };

    const saveCart = (cart) => {
        localStorage.setItem(CART_KEY, JSON.stringify(cart));
    };

    const addProduct = (product) => {
        const cart = getCart();
        const existingProduct = cart.find(item => item.productName === product.productName);

        if (existingProduct) {
            existingProduct.quantity = parseInt(existingProduct.quantity) + parseInt(product.quantity);
            existingProduct.subtotal = existingProduct.quantity * existingProduct.price;
        } else {
            cart.push(product);
        }

        saveCart(cart);
    };

    const removeProduct = (productName) => {
        let cart = getCart();
        cart = cart.filter(item => item.productName !== productName);
        saveCart(cart);
        renderCartPreview();
    };


    const editProduct = (productName, newDetails) => {
        const cart = getCart();
        const productIndex = cart.findIndex(item => item.productName === productName);

        if (productIndex !== -1) {
            cart[productIndex] = {...cart[productIndex], ...newDetails};
            saveCart(cart);
        }
    };

    const getProducts = () => {
        return getCart();
    };

    const clearCart = () => {
        localStorage.removeItem(CART_KEY);
    };

    return {
        addProduct,
        removeProduct,
        editProduct,
        getProducts,
        getSubTotal,
        clearCart
    };
})();
window.CartHook = CartHook


function createProductTemplate(cliente, produto, quantidade, preco, subtotal) {
    return `
        <div class="flex items-center space-x-4">
            <div class="w-1/4">
                <label class="block text-sm font-medium leading-6 text-gray-900">Cliente</label>
                <p class="text-gray-900">${cliente}</p>
            </div>
            <div class="w-1/4">
                <label class="block text-sm font-medium leading-6 text-gray-900">Produto</label>
                <p class="text-gray-900">${produto}</p>
            </div>
            <div class="w-1/4">
                <label class="block text-sm font-medium leading-6 text-gray-900">Quantidade</label>
                <p class="text-gray-900">${quantidade}</p>
            </div>
            <div class="w-1/4">
                <label class="block text-sm font-medium leading-6 text-gray-900">Preço</label>
                <p class="text-gray-900">${preco}</p>
            </div>
            <div class="w-1/4 my-1.5">
                <label class="block text-sm font-medium leading-6 text-gray-900">SubTotal</label>
                <p class="text-gray-900">${subtotal}</p>
            </div>
            <button type="button" onclick='CartHook.removeProduct("${produto}")' class="remove bg-red-500 text-white px-4 py-2 rounded">Remover</button>
        </div>
    `;
}


