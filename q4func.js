function filterTable() {
    const stockLocationFilter = document.getElementById("stockLocationFilter").value.toLowerCase();
    const classificationFilter = document.getElementById("classificationFilter").value.toLowerCase();
    const remarksFilter = document.getElementById("remarksFilter").value.toLowerCase();
    const table = document.getElementById("productTable");
    const rows = table.getElementsByTagName("tr");
    const noRecordsMessage = document.getElementById("noRecordsMessage");

    let hasVisibleRows = false;

    for (let i = 1; i < rows.length; i++) {
        const stockLocation = rows[i].getElementsByTagName("td")[0].textContent.trim().toLowerCase();
        const classification = rows[i].getElementsByTagName("td")[1].textContent.trim().toLowerCase();
        const remarksCell = rows[i].getElementsByTagName("td")[2];
        const remarks = remarksCell.textContent.trim().toLowerCase();

        const matchesStockLocation = stockLocationFilter === "" || stockLocation === stockLocationFilter;
        const matchesClassification = classificationFilter === "" || classification === classificationFilter;
        const matchesRemarks = remarksFilter === "" || remarks === remarksFilter;

        const isVisible = matchesStockLocation && matchesClassification && matchesRemarks;
        rows[i].style.display = isVisible ? "" : "none";

        if (isVisible) {
            hasVisibleRows = true;
        }

        // Apply color to the Remarks column based on its value
        if (remarks === "no available stock") {
            remarksCell.style.backgroundColor = "#780000"; // Dark red
        } else if (remarks === "low stock") {
            remarksCell.style.backgroundColor = "#BFBF30"; // Yellow
        } else if (remarks === "in stock") {
            remarksCell.style.backgroundColor = "#546A50"; // Green
        } else {
            remarksCell.style.backgroundColor = ""; // Reset to default if no match
        }
    }

    // Show or hide the "NO RECORDS AVAILABLE" message
    noRecordsMessage.style.display = hasVisibleRows ? "none" : "block";
}

document.addEventListener("DOMContentLoaded", () => {
    document.getElementById("stockLocationFilter").addEventListener("change", filterTable);
    document.getElementById("classificationFilter").addEventListener("change", filterTable);
    document.getElementById("remarksFilter").addEventListener("change", filterTable);

    // Add a "NO RECORDS AVAILABLE" message element below the table
    const table = document.getElementById("productTable");
    const noRecordsMessage = document.createElement("div");
    noRecordsMessage.id = "noRecordsMessage";
    noRecordsMessage.textContent = "NO RECORDS AVAILABLE";
    noRecordsMessage.style.textAlign = "center";
    noRecordsMessage.style.color = "red";
    noRecordsMessage.style.marginTop = "10px";
    noRecordsMessage.style.display = "none"; // Initially hidden
    table.parentNode.insertBefore(noRecordsMessage, table.nextSibling);

    // Apply colors to cells immediately when the page loads
    filterTable();
});