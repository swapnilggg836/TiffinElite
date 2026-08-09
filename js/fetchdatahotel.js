document.addEventListener("DOMContentLoaded", function () {
    let selectedHotelOrder = null;

    // Fetch hotel data and display it
    fetch("fetch_hotel.php")
        .then(response => response.json())
        .then(data => {
            const cardContainer = document.getElementById("hotel-card-container");
            if (cardContainer) cardContainer.classList.add("service-grid");

            // Iterate over the hotel data and create card elements
            data.forEach(hotel => {
                const card = document.createElement("div");
                card.className = "service-card";

                const photoUrl = (Array.isArray(hotel.menu_photos) && hotel.menu_photos.length > 0) ? hotel.menu_photos[0] : 'assets/img/default-hotel.png';
                const name = hotel.hotel_name || hotel.mess_name || 'Hotel Room';

                // Set the card content
                card.innerHTML = `
                    <div class="card-img-wrapper">
                        <img src="${photoUrl}" alt="${name}" onerror="this.src='assets/img/default-hotel.png';">
                    </div>
                    <div class="service-card-body">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                            <span class="badge">Hotel</span>
                            <span style="font-size: 0.8rem; color: var(--color-text-muted);">${hotel.service_type || 'Available'}</span>
                        </div>
                        <h3 class="service-card-title">${name}</h3>
                        <p style="font-weight: 600; font-size: 0.9rem; color: var(--color-primary-dark); margin-bottom: 6px;">Room / Menu: ${hotel.menu_name || hotel.room_type || 'Standard'}</p>
                        <p class="service-card-desc">${hotel.description || hotel.amenities || 'Comfortable stay with modern amenities.'}</p>
                        <div class="service-card-meta">
                            <span class="price">₹${hotel.menu_price || hotel.room_price}</span>
                        </div>
                        <div class="card-actions">
                            <button class="buy-now-btn btn-primary" data-menu-name="${hotel.menu_name || name}" data-price="${hotel.menu_price || hotel.room_price}">Buy Now</button>
                            <button class="add-to-cart-btn btn-secondary" data-id="${hotel.id}" data-name="${hotel.menu_name || name}" data-price="${hotel.menu_price || hotel.room_price}">Add to Cart</button>
                        </div>
                    </div>
                `;

                // Append the card to the container
                cardContainer.appendChild(card);
            });

            // Add event listeners for "Buy Now" buttons
            document.querySelectorAll(".buy-now-btn").forEach(button => {
                button.addEventListener("click", function () {
                    const menuName = this.getAttribute("data-menu-name");
                    const price = this.getAttribute("data-price");
                    openOrderModal(menuName, price);
                });
            });

            // Add event listeners for "Add to Cart" buttons
            document.querySelectorAll(".add-to-cart-btn").forEach(button => {
                button.addEventListener("click", function () {
                    const hotelId = this.getAttribute("data-id");
                    const hotelName = this.getAttribute("data-name");
                    const hotelPrice = this.getAttribute("data-price");

                    const cartItem = {
                        hotel_id: hotelId,
                        hotel_name: hotelName,
                        hotel_price: hotelPrice,
                    };

                    // Add to cart via API
                    fetch("add_to_cart_hotel.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify(cartItem)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(`${hotelName} added to cart!`);
                        } else {
                            alert("Failed to add item to cart. Please try again.");
                        }
                    })
                    .catch(error => {
                        console.error("Error adding to cart:", error);
                        alert("An error occurred while adding to the cart.");
                    });
                });
            });
        })
        .catch(error => console.error("Error fetching hotel data:", error));

    // Open the order modal
    function openOrderModal(menuName, price) {
        document.getElementById("hotel-order-modal").style.display = "block";
        document.getElementById("hotel-modal-overlay").style.display = "block";
        window.selectedMenuName = menuName;
        window.selectedMenuPrice = price;
    }

    // Close the order modal
    function closeOrderModal() {
        document.getElementById("hotel-order-modal").style.display = "none";
        document.getElementById("hotel-modal-overlay").style.display = "none";
    }

    document.getElementById("hotel-cancel-order").addEventListener("click", closeOrderModal);

    // Place the order
    document.getElementById("hotel-confirm-order").addEventListener("click", function () {
        const name = document.getElementById("hotel-user-name").value;
        const address = document.getElementById("hotel-user-address").value;
        const paymentMethod = document.getElementById("hotel-payment-method").value;
        const location = document.getElementById("hotel-user-location").value;

        if (!name || !address || !location) {
            alert("Please fill in all fields.");
            return;
        }

        fetch("orderhotel.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                menu_name: window.selectedMenuName,
                price: window.selectedMenuPrice,
                name: name,
                address: address,
                paymentMethod: paymentMethod,
                location: location
            })
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            closeOrderModal();
        })
        .catch(error => console.error("Error placing order:", error));
    });
});
