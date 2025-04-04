document.addEventListener("DOMContentLoaded", function () {
    const searchProduct = document.getElementById("searchProduct");
    const searchDescription = document.getElementById("searchDescription");
    const filterClassification = document.getElementById("filterClassification");
    const filterStock = document.getElementById("filterStock");
    const tableRows = document.querySelectorAll("#productTable tbody tr");

    function filterTable() {
        const productValue = searchProduct.value.toLowerCase();
        const descValue = searchDescription.value.toLowerCase();
        const classificationValue = filterClassification.value.toLowerCase();
        const stockValue = filterStock.value.toLowerCase();

        tableRows.forEach(row => {
            const productName = row.cells[0].textContent.toLowerCase();
            const description = row.cells[1].textContent.toLowerCase();
            const classification = row.cells[2].textContent.toLowerCase();
            const stockLocation = row.cells[3].textContent.toLowerCase();

            const matchesProduct = productName.includes(productValue);
            const matchesDesc = description.includes(descValue);
            const matchesClassification = classificationValue === "" || classification === classificationValue;
            const matchesStock = stockValue === "" || stockLocation === stockValue;

            if (matchesProduct && matchesDesc && matchesClassification && matchesStock) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }

    searchProduct.addEventListener("input", filterTable);
    searchDescription.addEventListener("input", filterTable);
    filterClassification.addEventListener("change", filterTable);
    filterStock.addEventListener("change", filterTable);
});