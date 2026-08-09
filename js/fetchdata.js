document.addEventListener("DOMContentLoaded", function () {
    fetch("fetch_mess.php")
        .then(response => response.json())
        .then(data => {
            const cardContainer = document.getElementById("card-container");
            if (cardContainer) cardContainer.classList.add("service-grid");

            data.forEach(mess => {
                const photos = Array.isArray(mess.menu_photos) && mess.menu_photos.length > 0 ? mess.menu_photos : ['assets/img/default-food.png'];
                const photoUrl = photos[0];
                const photosString = photos.join(',');

                const card = document.createElement("div");
                card.className = "service-card";
                card.innerHTML = `
                    <div class="card-img-wrapper">
                        <img src="${photoUrl}" alt="${mess.menu_name}" onerror="this.src='assets/img/default-food.png';">
                    </div>
                    <div class="service-card-body">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                            <span class="badge">Mess / Tiffin</span>
                            <span style="font-size: 0.8rem; color: var(--color-text-muted);">${mess.service_type || 'Online'}</span>
                        </div>
                        <h3 class="service-card-title">${mess.mess_name}</h3>
                        <p style="font-weight: 600; font-size: 0.9rem; color: var(--color-primary-dark); margin-bottom: 6px;">Menu: ${mess.menu_name}</p>
                        <p class="service-card-desc">${mess.description || 'Delicious home cooked fresh meals delivered daily.'}</p>
                        <div class="service-card-meta">
                            <span class="price">₹${mess.menu_price}</span>
                        </div>
                        <div class="card-actions">
                            <button class="buy-now-btn btn-primary" data-id="${mess.id}" data-name="${mess.mess_name}" data-price="${mess.menu_price}" data-photos="${photosString}">Buy Now</button>
                            <button class="add-to-cart-btn btn-secondary" data-id="${mess.id}" data-name="${mess.mess_name}" data-price="${mess.menu_price}">Add to Cart</button>
                        </div>
                    </div>
                `;
                cardContainer.appendChild(card);
            });

            // Handle Buy Now button click
            const buyNowButtons = document.querySelectorAll(".buy-now-btn");
            buyNowButtons.forEach(button => {
                button.addEventListener("click", function () {
                    const messName = this.getAttribute("data-name");
                    openOrderModal(messName);
                });
            });

            // Handle Add to Cart button click
            const addToCartButtons = document.querySelectorAll(".add-to-cart-btn");
            addToCartButtons.forEach(button => {
                button.addEventListener("click", function () {
                    const messId = this.getAttribute("data-id");
                    const messName = this.getAttribute("data-name");
                    const messPrice = this.getAttribute("data-price");

                    addToCart(messId, messName, messPrice);
                });
            });

            // Cancel the order
            document.getElementById("hotel-cancel-order").addEventListener("click", function () {
                closeOrderModal();
            });

            // Place the order
            document.getElementById("hotel-confirm-order").addEventListener("click", function () {
                placeOrder();
            });
        })
        .catch(error => console.error("Error fetching mess data:", error));

    // Open the order modal
    function openOrderModal(messName) {
        document.getElementById("hotel-order-modal").style.display = "block";
        document.getElementById("hotel-modal-overlay").style.display = "block";
        // Store the messName to use when placing the order
        window.selectedMessName = messName;
    }

    // Close the order modal
    function closeOrderModal() {
        document.getElementById("hotel-order-modal").style.display = "none";
        document.getElementById("hotel-modal-overlay").style.display = "none";
    }

    // Add to Cart
    function addToCart(messId, messName, messPrice) {
        const cartItem = {
            mess_id: messId,
            mess_name: messName,
            mess_price: messPrice,
        };

        fetch("add_to_cart.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(cartItem)
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message); // Show success message
        })
        .catch(error => console.error("Error adding to cart:", error));
    }

    // Place the order
    function placeOrder() {
        const name = document.getElementById("hotel-user-name").value;
        const address = document.getElementById("hotel-user-address").value;
        const paymentMethod = document.getElementById("hotel-payment-method").value;
        const location = document.getElementById("hotel-user-location").value;

        if (!name || !address || !location) {
            alert("Please fill in all fields.");
            return;
        }

        fetch("order.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                messName: window.selectedMessName, // Send mess name instead of ID
                name: name,
                address: address,
                paymentMethod: paymentMethod,
                location: location
            })
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message); // Show a success message
            closeOrderModal(); // Close the modal
        })
        .catch(error => console.error("Error placing order:", error));
    }
});
