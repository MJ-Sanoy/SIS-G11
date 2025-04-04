function applyCellColors() {
    const table = document.getElementById("productTable");
    const rows = table.getElementsByTagName("tr");

    for (let i = 1; i < rows.length; i++) {
        const numberOfStocksCell = rows[i].getElementsByTagName("td")[2];
        const numberOfStocks = parseInt(numberOfStocksCell.textContent.trim(), 10);
        const remarksCell = rows[i].getElementsByTagName("td")[3];
        const remarks = remarksCell.textContent.trim().toLowerCase();

        // Apply color to the Number of Stocks column
        if (numberOfStocks === 0) {
            numberOfStocksCell.style.backgroundColor = "#c14545";
        } else if (numberOfStocks > 0 && numberOfStocks <= 32) {
            numberOfStocksCell.style.backgroundColor = "#d8c14a";
        } else if (numberOfStocks > 32) {
            numberOfStocksCell.style.backgroundColor = "#349d7a"; 
        }

        // Apply color to the Remarks column based on its value
        if (remarks === "no available stock") {
            remarksCell.style.backgroundColor = "#c14545";
        } else if (remarks === "low stock") {
            remarksCell.style.backgroundColor = "#d8c14a"; 
        } else if (remarks === "in stock") {
            remarksCell.style.backgroundColor = "#349d7a";
        }
    }
}

function filterTable() {
    const classificationFilter = document.getElementById("classificationFilter").value.toLowerCase();
    const yearFilter = document.getElementById("yearFilter").value; // yyyy format
    const dateFilter = document.getElementById("dateFilter").value; // yyyy-mm format
    const fullDateFilter = document.getElementById("fullDateFilter").value; // yyyy-mm-dd format
    const stockFilter = document.getElementById("stockFilter").value;
    const remarksFilter = document.getElementById("remarksFilter").value.toLowerCase();
    const table = document.getElementById("productTable");
    const rows = table.getElementsByTagName("tr");
    const noRecordsMessage = document.getElementById("noRecordsMessage");

    let hasVisibleRows = false;

    for (let i = 1; i < rows.length; i++) {
        const classification = rows[i].getElementsByTagName("td")[0].textContent.trim().toLowerCase();
        const dateDelivered = rows[i].getElementsByTagName("td")[1].textContent.trim(); // yyyy-mm-dd format
        const numberOfStocksCell = rows[i].getElementsByTagName("td")[2];
        const numberOfStocks = parseInt(numberOfStocksCell.textContent.trim(), 10);
        const remarksCell = rows[i].getElementsByTagName("td")[3];
        const remarks = remarksCell.textContent.trim().toLowerCase();

        const year = dateDelivered.split('-')[0]; // Extract year from yyyy-mm-dd
        const yearMonth = dateDelivered.substring(0, 7); // Extract yyyy-mm from yyyy-mm-dd

        const matchesClassification = classificationFilter === "" || classification === classificationFilter;
        const matchesYear = yearFilter === "" || year === yearFilter;
        const matchesDate = dateFilter === "" || yearMonth === dateFilter;
        const matchesFullDate = fullDateFilter === "" || dateDelivered === fullDateFilter;

        let matchesStock = true;
        if (stockFilter === "0") {
            matchesStock = numberOfStocks === 0;
        } else if (stockFilter === "32") {
            matchesStock = numberOfStocks > 0 && numberOfStocks <= 32;
        } else if (stockFilter === "greater") {
            matchesStock = numberOfStocks > 32;
        }

        const matchesRemarks = remarksFilter === "" || remarks === remarksFilter;

        const isVisible = matchesClassification && matchesYear && matchesDate && matchesFullDate && matchesStock && matchesRemarks;
        rows[i].style.display = isVisible ? "" : "none";

        if (isVisible) {
            hasVisibleRows = true;
        }
    }

    // Show or hide the "NO RECORDS AVAILABLE" message
    noRecordsMessage.style.display = hasVisibleRows ? "none" : "block";
}

document.addEventListener("DOMContentLoaded", () => {
    document.getElementById("classificationFilter").addEventListener("change", filterTable);
    document.getElementById("yearFilter").addEventListener("change", filterTable);
    document.getElementById("dateFilter").addEventListener("change", filterTable);
    document.getElementById("fullDateFilter").addEventListener("change", filterTable);
    document.getElementById("stockFilter").addEventListener("change", filterTable);
    document.getElementById("remarksFilter").addEventListener("change", filterTable);

    // Add a "NO RECORDS AVAILABLE" message element below the table
    const table = document.getElementById("productTable");
    const noRecordsMessage = document.createElement("div");
    noRecordsMessage.id = "noRecordsMessage";
    noRecordsMessage.textContent = "NO RECORDS AVAILABLE";
    noRecordsMessage.style.textAlign = "center";
    noRecordsMessage.style.color = "red";
    noRecordsMessage.style.fontSize = "40px"; // Set font size to 40px
    noRecordsMessage.style.marginTop = "10px";
    noRecordsMessage.style.display = "none"; // Initially hidden
    table.parentNode.insertBefore(noRecordsMessage, table.nextSibling);

    // Apply colors to cells when the page loads
    applyCellColors();
});