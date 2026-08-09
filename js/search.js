document.addEventListener("DOMContentLoaded", function () {
    const searchForms = document.querySelectorAll(".header-search-form");

    searchForms.forEach(form => {
        const input = form.querySelector("input[type='text']");
        if (!input) return;

        // Create dropdown container for live results
        let dropdown = document.createElement("div");
        dropdown.className = "search-results-dropdown";
        form.style.position = "relative";
        form.appendChild(dropdown);

        let debounceTimer;

        input.addEventListener("input", function () {
            clearTimeout(debounceTimer);
            const query = input.value.trim();

            if (query.length < 2) {
                dropdown.style.display = "none";
                dropdown.innerHTML = "";
                return;
            }

            debounceTimer = setTimeout(() => {
                fetch(`search_api.php?q=${encodeURIComponent(query)}`)
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === "success" && data.results.length > 0) {
                            dropdown.innerHTML = data.results.map(item => `
                                <a href="search.php?q=${encodeURIComponent(query)}" class="search-item">
                                    <div>
                                        <strong>${item.title}</strong>
                                        <div style="font-size: 0.8rem; color: #6B7280;">${item.subtitle}</div>
                                    </div>
                                    <span style="color: #FF7A00; font-weight: 700;">₹${item.price}</span>
                                </a>
                            `).join("");
                            dropdown.style.display = "block";
                        } else {
                            dropdown.innerHTML = `<div class="search-item" style="color: #6B7280;">No items matching "${query}"</div>`;
                            dropdown.style.display = "block";
                        }
                    })
                    .catch(err => console.error("Live search error:", err));
            }, 300);
        });

        // Close dropdown on click outside
        document.addEventListener("click", function (e) {
            if (!form.contains(e.target)) {
                dropdown.style.display = "none";
            }
        });
    });
});
