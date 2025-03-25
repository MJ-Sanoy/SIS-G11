document.addEventListener("DOMContentLoaded", function () {
    const table = document.querySelector(".product-table");
    const headers = table.querySelectorAll(".table-heading");
    const tbody = table.querySelector("tbody");

    headers.forEach((header, index) => {
        let ascending = true; // Track sorting order

        header.addEventListener("click", function () {
            const rows = Array.from(tbody.querySelectorAll(".table-row"));

            // Sort rows based on the clicked column
            rows.sort((rowA, rowB) => {
                const cellA = rowA.querySelectorAll(".table-cell")[index].textContent.trim();
                const cellB = rowB.querySelectorAll(".table-cell")[index].textContent.trim();

                if (!isNaN(cellA) && !isNaN(cellB)) {
                    // Compare numbers
                    return ascending ? cellA - cellB : cellB - cellA;
                } else {
                    // Compare strings
                    return ascending
                        ? cellA.localeCompare(cellB)
                        : cellB.localeCompare(cellA);
                }
            });

            // Append sorted rows back to the table body
            rows.forEach(row => tbody.appendChild(row));

            // Update arrow indicator for all headers
            headers.forEach(h => {
                h.textContent = h.textContent.replace(" ↑", "").replace(" ↓", "");
            });

            // Add arrow to the clicked header
            header.textContent += ascending ? " ↑" : " ↓";

            // Toggle sorting order
            ascending = !ascending;
        });
    });
});