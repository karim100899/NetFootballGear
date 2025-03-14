document.addEventListener('DOMContentLoaded', function() {
    // Product data
    const products = [
        {
            id: 1,
            title: "Shirt Lewandowski",
            price: "€ prijs",
            description: "Lewandowski shirt (jaar) en (club)",
            image: "https://via.placeholder.com/300x300"
        },
        {
            id: 2,
            title: "Shirt Lewandowski",
            price: "€ prijs",
            description: "Lewandowski shirt (jaar) en (club)",
            image: "https://via.placeholder.com/300x300"
        },
        {
            id: 3,
            title: "Shirt Lewandowski",
            price: "€ prijs",
            description: "Lewandowski shirt (jaar) en (club)",
            image: "https://via.placeholder.com/300x300"
        },
        {
            id: 4,
            title: "Shirt Lewandowski",
            price: "€ prijs",
            description: "Lewandowski shirt (jaar) en (club)",
            image: "https://via.placeholder.com/300x300"
        },
        {
            id: 5,
            title: "Shirt Lewandowski",
            price: "€ prijs",
            description: "Lewandowski shirt (jaar) en (club)",
            image: "https://via.placeholder.com/300x300"
        },
        {
            id: 6,
            title: "Shirt Lewandowski",
            price: "€ prijs",
            description: "Lewandowski shirt (jaar) en (club)",
            image: "https://via.placeholder.com/300x300"
        },
        {
            id: 7,
            title: "Shirt Lewandowski",
            price: "€ prijs",
            description: "Lewandowski shirt (jaar) en (club)",
            image: "https://via.placeholder.com/300x300"
        },
        {
            id: 8,
            title: "Shirt Lewandowski",
            price: "€ prijs",
            description: "Lewandowski shirt (jaar) en (club)",
            image: "https://via.placeholder.com/300x300"
        }
    ];

    // Function to render products
    function renderProducts() {
        const productGrid = document.getElementById('productGrid');
        
        products.forEach(product => {
            const productCard = document.createElement('div');
            productCard.className = 'product-card';
            
            productCard.innerHTML = `
                <div class="product-image">
                    <img src="${product.image}" alt="${product.title}">
                </div>
                <h3 class="product-title">${product.title}</h3>
                <p class="product-price">${product.price}</p>
                <p class="product-description">${product.description}</p>
            `;
            
            // Add click event to navigate to product detail page
            productCard.addEventListener('click', function() {
                // In a real application, this would navigate to a product detail page
                console.log(`Clicked on product ${product.id}`);
                // window.location.href = `product.html?id=${product.id}`;
            });
            
            productGrid.appendChild(productCard);
        });
    }

    // Initialize the page
    renderProducts();

    // Search functionality
    const searchInput = document.querySelector('.search-input');
    const searchButton = document.querySelector('.search-button');

    function handleSearch() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        if (searchTerm === '') return;
        
        console.log(`Searching for: ${searchTerm}`);
        // In a real application, this would filter products or navigate to search results
        alert(`Search for: ${searchTerm}`);
    }

    searchButton.addEventListener('click', handleSearch);
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            handleSearch();
        }
    });

    // Newsletter subscription
    const subscribeButton = document.querySelector('.subscribe-button');
    const emailInput = document.querySelector('.subscribe-input');

    subscribeButton.addEventListener('click', function() {
        const email = emailInput.value.trim();
        if (email === '') {
            alert('Please enter your email address');
            return;
        }
        
        // In a real application, this would send the email to a server
        console.log(`Subscribing email: ${email}`);
        alert(`Thank you for subscribing with: ${email}`);
        emailInput.value = '';
    });
});