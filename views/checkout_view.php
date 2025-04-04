<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - NetFootballGear</title>
    <link rel="icon" href="images/NetFootballGear-flaticon.png" type="image/png">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/checkout.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="checkout-container">
        <div class="checkout-header">
            <h1>Checkout</h1>
            <p>Complete your order</p>
        </div>

        <?php if (isset($error)): ?>
            <div class="error-message">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <div class="checkout-content">
            <div class="order-summary">
                <h2>Order Summary</h2>
                <div class="cart-items">
                    <?php foreach ($cartItems as $item): ?>
                        <div class="cart-item">
                            <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>">
                            <div class="item-details">
                                <h3><?php echo htmlspecialchars($item['title']); ?></h3>
                                <p>Quantity: <?php echo $item['quantity']; ?></p>
                                <p class="price">€ <?php echo number_format($item['price'] * $item['quantity'], 2); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="order-total">
                    <h3>Total: € <?php echo number_format($cartTotal, 2); ?></h3>
                </div>
            </div>

            <div class="checkout-form">
                <?php if (isLoggedIn()): ?>
                    <!-- Logged in user form -->
                    <h2>Shipping Information</h2>
                    <form action="process_order.php" method="POST" class="shipping-form">
                        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">

                        <div class="form-group">
                            <label for="postal_code">Postal Code</label>
                            <input type="text" id="postal_code" name="postal_code" required>
                        </div>

                        <div class="form-group">
                            <label for="house_number">House Number</label>
                            <input type="number" id="house_number" name="house_number" required>
                        </div>

                        <div class="form-group">
                            <label for="street">Street Address</label>
                            <input type="text" id="street" name="street" required>
                        </div>

                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" id="city" name="city" required>
                        </div>

                        <div class="form-group">
                            <label for="country">Province</label>
                            <input type="text" id="country" name="country" required>
                        </div>

                        <button type="submit" class="place-order-btn">Place Order</button>
                    </form>
                <?php else: ?>
                    <!-- Guest checkout form -->
                    <h2>Guest Checkout</h2>
                    <form action="process_order.php" method="POST" class="guest-form">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" id="name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" required>
                        </div>

                        <div class="form-group">
                            <label for="postal_code">Postal Code</label>
                            <input type="text" id="postal_code" name="postal_code" required>
                        </div>

                        <div class="form-group">
                            <label for="house_number">House Number</label>
                            <input type="number" id="house_number" name="house_number" required>
                        </div>

                        <div class="form-group">
                            <label for="street">Street Address</label>
                            <input type="text" id="street" name="street" required>
                        </div>

                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" id="city" name="city" required>
                        </div>

                        <div class="form-group">
                            <label for="country">Province</label>
                            <input type="text" id="country" name="country" required>
                        </div>

                        <button type="submit" class="place-order-btn">Place Order</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <script src="js/main.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const postalCodeInput = document.getElementById('postal_code');
            const houseNumberInput = document.getElementById('house_number');
            const streetInput = document.getElementById('street');
            const cityInput = document.getElementById('city');
            const countryInput = document.getElementById('country');
            const emailInput = document.getElementById('email');
            const phoneInput = document.getElementById('phone');
            const form = document.querySelector('form'); // Select the form for validation
            const placeOrderButton = document.querySelector('.place-order-btn'); // Select the Place Order button

            postalCodeInput.addEventListener('change', fetchAddress);
            houseNumberInput.addEventListener('change', fetchAddress);

            function fetchAddress() {
                const postcode = postalCodeInput.value;
                const huisnummer = houseNumberInput.value;

                if (postcode && huisnummer) {
                    const apiUrl = `https://api.pdok.nl/bzk/locatieserver/search/v3_1/free?fq=type:adres&q=${postcode} ${huisnummer}`;
                    
                    fetch(apiUrl)
                        .then(response => response.json())
                        .then(data => {
                            if (data && data.response && data.response.docs.length > 0) {
                                const address = data.response.docs[0];
                                streetInput.value = address.straatnaam;
                                cityInput.value = address.woonplaatsnaam;
                                countryInput.value = address.provincienaam;

                                // Enable the Place Order button if address is found
                                placeOrderButton.disabled = false;
                            } else {
                                alert('Address not found. Please check your postcode and house number.');
                                // Disable the Place Order button if address is not found
                                placeOrderButton.disabled = true;
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching address:', error);
                            alert('An error occurred while fetching the address.');
                            // Disable the Place Order button on error
                            placeOrderButton.disabled = true;
                        });
                } else {
                    // Disable the Place Order button if postcode or house number is empty
                    placeOrderButton.disabled = true;
                }
            }

            // Form validation before submission
            form.addEventListener('submit', function(event) {
                let valid = true;

                // Validate email if present
                if (emailInput) {
                    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailPattern.test(emailInput.value)) {
                        alert('Please enter a valid email address.');
                        valid = false;
                    }
                }

                // Validate phone number (only digits)
                if (phoneInput) {
                    const phonePattern = /^\d+$/; // Only digits
                    if (!phonePattern.test(phoneInput.value)) {
                        alert('Phone number must contain only digits.');
                        valid = false;
                    }
                }

                // Validate house number (only digits)
                const houseNumberPattern = /^\d+$/; // Only digits
                if (!houseNumberPattern.test(houseNumberInput.value)) {
                    alert('House number must contain only digits.');
                    valid = false;
                }

                // Validate postal code (basic check for format)
                if (postalCodeInput.value.trim() === '') {
                    alert('Postal code is required.');
                    valid = false;
                }

                // Validate street, city, and country fields
                if (streetInput.value.trim() === '' || cityInput.value.trim() === '' || countryInput.value.trim() === '') {
                    alert('All address fields are required.');
                    valid = false;
                }

                // Check if the Place Order button is disabled (address not found)
                if (placeOrderButton.disabled) {
                    alert('Please ensure that the address is valid before placing the order.');
                    valid = false;
                }

                // Prevent form submission if validation fails
                if (!valid) {
                    event.preventDefault();
                }
            });
        });
    </script>
</body>
</html> 