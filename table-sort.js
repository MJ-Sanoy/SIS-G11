document.addEventListener("DOMContentLoaded", function () {
    const table = document.querySelector(".product-table");
    const headers = table.querySelectorAll(".table-heading");
    const tbody = table.querySelector("tbody");

    headers.forEach((header, index) => {
        let ascending = true;

        header.addEventListener("click", function () {
            const rows = Array.from(tbody.querySelectorAll(".table-row"));

            rows.sort((rowA, rowB) => {
                const cellA = rowA.querySelectorAll(".table-cell")[index].textContent.trim();
                const cellB = rowB.querySelectorAll(".table-cell")[index].textContent.trim();

                if (!isNaN(cellA) && !isNaN(cellB)) {
                    return ascending ? cellA - cellB : cellB - cellA;
                } else {
                    return ascending
                        ? cellA.localeCompare(cellB)
                        : cellB.localeCompare(cellA);
                }
            });

            rows.forEach(row => tbody.appendChild(row));

            headers.forEach(h => {
                h.textContent = h.textContent.replace(" ↑", "").replace(" ↓", "");
            });

            header.textContent += ascending ? " ↑" : " ↓";

            ascending = !ascending;
        });
    });
});