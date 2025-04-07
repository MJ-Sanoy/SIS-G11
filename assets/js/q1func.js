document.addEventListener("DOMContentLoaded", function () {
    const searchProduct = document.getElementById("searchProduct");
    const searchDescription = document.getElementById("searchDescription");
    const filterClassification = document.getElementById("filterClassification");
    const filterStock = document.getElementById("filterStock");
    const tableRows = document.querySelectorAll("#productTable tbody tr");

    // Create the "NO RECORDS AVAILABLE" message only once
    let noRecordsMessage = document.getElementById("noRecordsMessage");
    if (!noRecordsMessage) {
        noRecordsMessage = document.createElement("div");
        noRecordsMessage.id = "noRecordsMessage";
        noRecordsMessage.textContent = "NO RECORDS AVAILABLE";
        noRecordsMessage.style.textAlign = "center";
        noRecordsMessage.style.color = "red";
        noRecordsMessage.style.fontSize = "40px";
        noRecordsMessage.style.marginTop = "10px";
        noRecordsMessage.style.whiteSpace = "nowrap"; // Prevent wrapping
        noRecordsMessage.style.display = "none"; 
        document.getElementById("productTable").parentNode.insertBefore(noRecordsMessage, document.getElementById("productTable").nextSibling);
    }

    function filterTable() {
        const productValue = searchProduct.value.toLowerCase();
        const descValue = searchDescription.value.toLowerCase();
        const classificationValue = filterClassification.value.toLowerCase();
        const stockValue = filterStock.value.toLowerCase();

        let hasVisibleRows = false;

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
                hasVisibleRows = true;
            } else {
                row.style.display = "none";
            }
        });

        // Show or hide the "NO RECORDS AVAILABLE" message based on filtered results
        if (hasVisibleRows) {
            noRecordsMessage.style.display = "none"; // Hide if records are found
        } else {
            noRecordsMessage.style.display = "block"; // Show if no records are found
        }
    }

    searchProduct.addEventListener("input", filterTable);
    searchDescription.addEventListener("input", filterTable);
    filterClassification.addEventListener("change", filterTable);
    filterStock.addEventListener("change", filterTable);
});