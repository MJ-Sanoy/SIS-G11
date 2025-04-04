document.addEventListener("DOMContentLoaded", function () {
    const table = document.querySelector(".product-table");
    const headers = table.querySelectorAll(".table-heading");
    const tbody = table.querySelector("tbody");
    const originalRows = Array.from(tbody.querySelectorAll(".table-row")); // Store initial order

    // Define sortable columns by their header text
    const sortableColumns = [
        "Product ID",
        "Product Name",
        "Description",
        "Classification",
        "Storage Location",
        "Stock Number",
        "Date Delivered",
        "Remarks"
    ];

    headers.forEach((header, index) => {
        let ascending = true; // Track sorting order

        // Check if the column is sortable
        if (!sortableColumns.includes(header.textContent.trim())) {
            return; // Skip non-sortable columns
        }

        header.addEventListener("click", function () {
            const rows = Array.from(tbody.querySelectorAll(".table-row"));

            // Sort rows based on clicked column
            rows.sort((rowA, rowB) => {
                const cellA = rowA.querySelectorAll(".table-cell")[index];
                const cellB = rowB.querySelectorAll(".table-cell")[index];

                let valueA, valueB;

                // Handle sorting for <select> inputs
                if (cellA.querySelector("select") && cellB.querySelector("select")) {
                    valueA = cellA.querySelector("select").value.trim().toLowerCase();
                    valueB = cellB.querySelector("select").value.trim().toLowerCase();
                } else if (index === 6) { // Handle sorting for Date Delivered column (index 6)
                    valueA = new Date(cellA.querySelector("input").value.trim());
                    valueB = new Date(cellB.querySelector("input").value.trim());
                    return ascending ? valueA - valueB : valueB - valueA;
                } else {
                    // Handle sorting for regular text content
                    valueA = cellA.textContent.trim().toLowerCase();
                    valueB = cellB.textContent.trim().toLowerCase();
                }

                if (!isNaN(valueA) && !isNaN(valueB)) {
                    return ascending ? valueA - valueB : valueB - valueA;
                } else {
                    return ascending ? valueA.localeCompare(valueB) : valueB.localeCompare(valueA);
                }
            });

            rows.forEach(row => tbody.appendChild(row)); // Append sorted rows back

            // Apply colors to the Remarks column
            rows.forEach(row => {
                const remarksCell = row.querySelectorAll(".table-cell")[7]; // Updated index for Remarks column
                const remarks = remarksCell.textContent.trim().toLowerCase();

                if (remarks === "no available stock") {
                    remarksCell.style.backgroundColor = "#780000"; // Dark red
                } else if (remarks === "low stock") {
                    remarksCell.style.backgroundColor = "#BFBF30"; // Yellow
                } else if (remarks === "in stock") {
                    remarksCell.style.backgroundColor = "#546A50"; // Green
                } else {
                    remarksCell.style.backgroundColor = ""; // Reset to default if no match
                }
            });

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
                    rows.forEach(row => {
                        const remarksCell = row.querySelectorAll(".table-cell")[7]; // Updated index for Remarks column
                        const remarks = remarksCell.textContent.trim().toLowerCase();

                        if (remarks === "no available stock") {
                            remarksCell.style.backgroundColor = "#780000"; // Dark red
                        } else if (remarks === "low stock") {
                            remarksCell.style.backgroundColor = "#BFBF30"; // Yellow
                        } else if (remarks === "in stock") {
                            remarksCell.style.backgroundColor = "#546A50"; // Green
                        } else {
                            remarksCell.style.backgroundColor = ""; // Reset to default if no match
                        }
                    });
                    resetButton.remove(); // Remove reset button after reset
                    ascending = true; // Reset sorting order
                });
            }

            ascending = !ascending; // Toggle sorting order
        });
    });

    // Apply colors to Remarks column immediately on page load
    const rows = Array.from(tbody.querySelectorAll(".table-row"));
    rows.forEach(row => {
        const remarksCell = row.querySelectorAll(".table-cell")[7]; // Updated index for Remarks column
        const remarks = remarksCell.textContent.trim().toLowerCase();

        if (remarks === "no available stock") {
            remarksCell.style.backgroundColor = "#780000"; // Dark red
        } else if (remarks === "low stock") {
            remarksCell.style.backgroundColor = "#BFBF30"; // Yellow
        } else if (remarks === "in stock") {
            remarksCell.style.backgroundColor = "#546A50"; // Green
        } else {
            remarksCell.style.backgroundColor = ""; // Reset to default if no match
        }
    });
});