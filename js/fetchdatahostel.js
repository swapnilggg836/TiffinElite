document.addEventListener("DOMContentLoaded", function () {
    let selectedHotelOrder = null;

    // Fetch hotel data and display it
    fetch("fetch_hostel.php")
        .then(response => response.json())
        .then(data => {
            const cardContainer = document.getElementById("hotel-card-containerr");

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
                        <button class="hotel-buy-now-btn" data-id="${hotel.id}" data-name="${hotel.menu_name}" data-price="${hotel.menu_price}" data-photos="${hotel.menu_photos.join(',')}">Order Now</button>
                        <button class="hotel-add-to-cart-btn" data-id="${hotel.id}" data-name="${hotel.menu_name}" data-price="${hotel.menu_price}">Add to Cart</button>
                    </div>
                `;

                // Append the card to the container
                cardContainer.appendChild(card);
            });

            // Add event listeners for "Buy Now" buttons
            document.querySelectorAll(".hotel-buy-now-btn").forEach(button => {
                button.addEventListener("click", function () {
                    // Store the selected hotel details
                    selectedHotelOrder = {
                        id: this.getAttribute("data-id"),
                        name: this.getAttribute("data-name"),
                        price: this.getAttribute("data-price"),
                        photos: this.getAttribute("data-photos").split(','),  // Handle multiple photos
                    };
                    showModal();  // Show the modal
                });
            });

            // Add event listeners for "Add to Cart" buttons
            document.querySelectorAll(".hotel-add-to-cart-btn").forEach(button => {
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

    const modal = document.getElementById("hotel-order-modal");
    const overlay = document.getElementById("hotel-modal-overlay");

    // Show modal
    function showModal() {
        modal.style.display = "block";
        overlay.style.display = "block";
    }

    // Hide modal
    function hideModal() {
        modal.style.display = "none";
        overlay.style.display = "none";
    }

    // Close modal on cancel
    document.getElementById("hotel-cancel-order").addEventListener("click", hideModal);

    // Place order when confirmed
    document.getElementById("hotel-confirm-order").addEventListener("click", function () {
        const userName = document.getElementById("hotel-user-name").value;
        const userAddress = document.getElementById("hotel-user-address").value;
        const paymentMethod = document.getElementById("hotel-payment-method").value;
        const userLocation = document.getElementById("hotel-user-location").value;

        // Validate form
        if (!userName || !userAddress || !userLocation) {
            alert("Please fill in all required fields.");
            return;
        }

        // Construct order details
        const orderDetails = {
            hotel_id: selectedHotelOrder.id,  // Selected hotel ID
            hotel_name: selectedHotelOrder.mess_name,  // Hotel name
            menu_name: selectedHotelOrder.menu_name,  // Menu name
            price: selectedHotelOrder.menu_price,      // Menu price
            user_name: userName,
            user_address: userAddress,
            payment_method: paymentMethod,
            user_location: userLocation,
            order_status: "Pending",  // Default order status
            order_date: new Date().toISOString(),  // Current date in ISO format
        };

        // Send order details to backend
        fetch("order_hotel.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(orderDetails)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Order placed successfully!");
                hideModal();  // Hide modal after order
            } else {
                alert("Failed to place the order. Please try again.");
            }
        })
        .catch(error => {
            console.error("Error placing order:", error);
            alert("An error occurred while placing the order.");
        });
    });
});
