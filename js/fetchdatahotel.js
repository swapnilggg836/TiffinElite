document.addEventListener("DOMContentLoaded", function () {
    let selectedHotelOrder = null;

    // Fetch hotel data and display it
    fetch("fetch_hotel.php")
        .then(response => response.json())
        .then(data => {
            const cardContainer = document.getElementById("hotel-card-container");

            // Iterate over the hotel data and create card elements
            data.forEach(hotel => {
                const card = document.createElement("div");
                card.className = "hotel-card";

                // Generate photos for the hotel menu
                const photos = hotel.menu_photos.map(photo => `<img src="${photo}" alt="${hotel.menu_name}">`).join("");

                // Set the card content
                card.innerHTML = `
                    ${photos}
                    <div class="hotel-card-content">
                        <h3>${hotel.mess_name}</h3>
                        <p>Menu: ${hotel.menu_name}</p>
                        <p>${hotel.description}</p>
                        <p class="hotel-price">Price: ₹${hotel.menu_price}</p>
                        <button class="buy-now-btn" data-menu-name="${hotel.menu_name}" data-price="${hotel.menu_price}">Buy Now</button>
                        <button class="add-to-cart-btn" data-id="${hotel.id}" data-name="${hotel.menu_name}" data-price="${hotel.menu_price}">Add to Cart</button>
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
