document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('search-product');
    const product_id = document.getElementById('product_id');
    const resultsContainer = document.getElementById('product-search-results');
    const unitValue = document.getElementById('unitvalue');
    const subtotal = document.getElementById('subtotal');
    const quantity = document.getElementById('qtd');
    function showProductDropdown(query) {
        if (query.length > 0) {
            fetchSearchResults(query);
        } else {
            fetchListResults()
        }
    }

    function updateResults(results) {
        resultsContainer.innerHTML = '';
        results.forEach(result => {
            const li = document.createElement('li');
            li.className = 'p-2 hover:bg-gray-200 cursor-pointer';
            li.textContent = result.name + " |  R$ " + result.price;
            li.addEventListener('click', () => {
                product_id.value=result.id;
                searchInput.value = result.name;
                unitValue.value = result.price;
                quantity.value = 1;
                subtotal.value = quantity.value * result.price;
                quantity.addEventListener('change', () => {
                    subtotal.value = quantity.value * result.price;
                });
                resultsContainer.classList.add('hidden');
            });
            resultsContainer.appendChild(li);
        });
        resultsContainer.classList.remove('hidden');
    }

    async function fetchSearchResults(name) {
        try {
            const response = await fetch(`/products/search/${name}`);
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const data = await response.json();
            updateResults(data);
        } catch (error) {
            console.error('Fetch error:', error);
        }
    }

    async function fetchListResults() {
        try {
            const response = await fetch(`/products/list`);
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const data = await response.json();
            updateResults(data);
        } catch (error) {
            console.error('Fetch error:', error);
        }
    }

    window.showProductDropdown = showProductDropdown;

    document.addEventListener('click', (event) => {
        if (!resultsContainer.contains(event.target) && !searchInput.contains(event.target)) {
            resultsContainer.classList.add('hidden');
        }
    });
});

//popup handler
document.addEventListener('DOMContentLoaded', function () {
    var openPopupButton = document.getElementById('openPopup');
    var closePopupButton = document.getElementById('closePopup');
    var popup = document.getElementById('popup');

    openPopupButton.addEventListener('click', function () {
        popup.classList.remove('hidden');
    });

    closePopupButton.addEventListener('click', function () {
        popup.classList.add('hidden');
    });

    popup.addEventListener('click', function (event) {
        if (event.target === popup) {
            popup.classList.add('hidden');
        }
    });
});

const addProduct = () =>{
    if(document.getElementById('product-container').children.length===0)
        document.getElementById('add-product').click()
    document.getElementById('showSubTotal').value=CartHook.getSubTotal()

}
window.addProduct = addProduct

const updateTotal = () => {
    const products = document.getElementById('product-container');
    const currentDate = new Date();
    const futureDate = new Date(currentDate);
    Array.from(products.children).forEach(item=>{

        futureDate.setDate(currentDate.getDate() + 30);

        const formattedDate = futureDate.toISOString().split('T')[0];
        const parcela = item.querySelector('.parcela')
        const date = item.querySelector('.date')
        const payment = item.querySelector('.payment-method ')
        payment.addEventListener('change', () => {
            date.readOnly=true;
            parcela.readOnly=true;
            if(payment.value==='custom'){
                date.readOnly=false;
                parcela.readOnly=false;
            }
            });
        date.onclick = () => {
            if(date.readOnly)
                showAlert('Você não pode editar essa data! Troque o pagamento para personalizado para modificar')
        }
        parcela.onclick = () => {
            if(date.readOnly)
                showAlert('Você não pode editar essa parcela! Troque o pagamento para personalizado para modificar')
        }

        date.value=formattedDate;
        parcela.value=(CartHook.getSubTotal()/products.children.length).toFixed(2);
    })
}



document.addEventListener('DOMContentLoaded', () => {

    const addProductButton = document.getElementById('add-product');
    const removeProductButton = document.getElementById('remove-product');
    const quantity = document.getElementById('quantity');
    const productContainer = document.getElementById('product-container');
    const productTemplate = document.getElementById('product-template').innerHTML;

    const addProductRow = () => {
        const productRow = document.createElement('div');
        productRow.innerHTML = productTemplate;
        productContainer.appendChild(productRow);
        quantity.value++;
        updateTotal()
        productRow.querySelector('.remove').addEventListener('click', () => {
            quantity.value--;
            productRow.remove();
            updateTotal()
        });
    };

    const remove = () => {
        productContainer.children[0].remove()
        if(quantity.value>0) {
            quantity.value--
            updateTotal()
        }
    }
    addProductButton.addEventListener('click', addProductRow);
    removeProductButton.addEventListener('click', remove);


    document.getElementById('checkout-form').onsubmit = function (event) {
        let total = 0;
        Array.from(productContainer.children).forEach(item=> {
            total+=parseInt(item.querySelector('.parcela').value)
        })

        if(total!==parseInt(CartHook.getSubTotal())){
            event.preventDefault();
            showAlert("O somatorio das parcelas deve ser igual ao subtotal!")
        }

    };
});

