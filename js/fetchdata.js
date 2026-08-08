document.addEventListener("DOMContentLoaded", function () {
    fetch("fetch_mess.php")
        .then(response => response.json())
        .then(data => {
            const cardContainer = document.getElementById("card-container");
            data.forEach(mess => {
                const card = document.createElement("div");
                card.className = "card";
                card.innerHTML = `
                    <img src="${mess.menu_photos[0]}" alt="${mess.menu_name}">
                    <div class="card-content">
                        <h3>${mess.mess_name}</h3>
                        <p>Menu: ${mess.menu_name}</p>
                        <p>${mess.description}</p>
                        <p class="price">Price: ₹${mess.menu_price}</p>
                        <p class="service-type">Service: ${mess.service_type}</p>
                        <button class="buy-now-btn" data-id="${mess.id}" data-name="${mess.mess_name}" data-price="${mess.menu_price}" data-photos="${mess.menu_photos.join(',')}">Buy Now</button>
                        <button class="add-to-cart-btn" data-id="${mess.id}" data-name="${mess.mess_name}" data-price="${mess.menu_price}">Add to Cart</button>
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
