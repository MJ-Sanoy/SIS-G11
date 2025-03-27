document.addEventListener("DOMContentLoaded", function () {
    const table = document.querySelector(".product-table");
    const headers = table.querySelectorAll(".table-heading");
    const tbody = table.querySelector("tbody");
    const originalRows = Array.from(tbody.querySelectorAll(".table-row")); // Store initial order

    headers.forEach((header, index) => {
        let ascending = true; // Track sorting order

        header.addEventListener("click", function () {
            const rows = Array.from(tbody.querySelectorAll(".table-row"));

            // Sort rows based on clicked column
            rows.sort((rowA, rowB) => {
                const cellA = rowA.querySelectorAll(".table-cell")[index].textContent.trim();
                const cellB = rowB.querySelectorAll(".table-cell")[index].textContent.trim();

                if (!isNaN(cellA) && !isNaN(cellB)) {
                    return ascending ? cellA - cellB : cellB - cellA;
                } else {
                    return ascending ? cellA.localeCompare(cellB) : cellB.localeCompare(cellA);
                }
            });

            rows.forEach(row => tbody.appendChild(row)); // Append sorted rows back

            // Remove previous arrows
            headers.forEach(h => {
                h.innerHTML = h.innerHTML.replace(" ↑", "").replace(" ↓", "");
            });

            // Add sorting indicator
            header.innerHTML = `${header.textContent} ${ascending ? "↑" : "↓"}`;

            // Ensure only one reset button exists across all columns
            const existingResetButton = document.querySelector(".reset-button");
            if (!existingResetButton) {
                const resetButton = document.createElement("button");
                resetButton.textContent = "Reset";
                resetButton.classList.add("reset-button");
                resetButton.style.backgroundColor = "lightcoral";
                resetButton.style.border = "none";
                resetButton.style.padding = "5px 10px";
                resetButton.style.cursor = "pointer";
                resetButton.style.marginBottom = "5px";
                resetButton.style.display = "block";
                resetButton.title = "Reset to default order";

                header.parentElement.insertAdjacentElement("beforebegin", resetButton);

                resetButton.addEventListener("click", function (e) {
                    e.stopPropagation(); // Prevent triggering sort event
                    originalRows.forEach(row => tbody.appendChild(row)); // Reset table order
                    headers.forEach(h => h.innerHTML = h.textContent.replace(" ↑", "").replace(" ↓", ""));
                    resetButton.remove(); // Remove reset button after reset
                    ascending = true; // Reset sorting order
                });
            }

            ascending = !ascending; // Toggle sorting order
        });
    });
});
