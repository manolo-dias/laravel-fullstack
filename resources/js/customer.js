document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('search-customer');
    const customer_id = document.getElementById('customer_id');
    const resultsContainer = document.getElementById('customer-search-results');

    function showCustomerDropdown(query) {
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
            li.textContent = result.name;
            li.addEventListener('click', () => {
                searchInput.value = result.name;
                customer_id.value = result.id;
                resultsContainer.classList.add('hidden');
            });
            resultsContainer.appendChild(li);
        });
        resultsContainer.classList.remove('hidden');
    }

    async function fetchSearchResults(name) {
        try {
            const response = await fetch(`/customers/search/${name}`);
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
            const response = await fetch(`/customers/list`);
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const data = await response.json();
            updateResults(data);
        } catch (error) {
            console.error('Fetch error:', error);
        }
    }

    window.showCustomerDropdown = showCustomerDropdown;

    document.addEventListener('click', (event) => {
        if (!resultsContainer.contains(event.target) && !searchInput.contains(event.target)) {
            resultsContainer.classList.add('hidden');
        }
    });
});
