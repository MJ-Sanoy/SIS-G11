function filterTable() {
    const classificationFilter = document.getElementById("classificationFilter").value.toLowerCase();
    const yearFilter = document.getElementById("yearFilter").value; // yyyy format
    const dateFilter = document.getElementById("dateFilter").value; // yyyy-mm format
    const fullDateFilter = document.getElementById("fullDateFilter").value; // yyyy-mm-dd format
    const table = document.getElementById("productTable");
    const rows = table.getElementsByTagName("tr");
    const noRecordsMessage = document.getElementById("noRecordsMessage");

    let hasVisibleRows = false;

    for (let i = 1; i < rows.length; i++) {
        const classification = rows[i].getElementsByTagName("td")[0].textContent.trim().toLowerCase();
        const date = rows[i].getElementsByTagName("td")[1].textContent.trim(); // yyyy-mm-dd format
        const year = date.split('-')[0]; // Extract year from yyyy-mm-dd
        const yearMonth = date.substring(0, 7); // Extract yyyy-mm from yyyy-mm-dd

        const matchesClassification = classificationFilter === "" || classification === classificationFilter;
        const matchesYear = yearFilter === "" || year === yearFilter;
        const matchesDate = dateFilter === "" || yearMonth === dateFilter;
        const matchesFullDate = fullDateFilter === "" || date === fullDateFilter;

        const isVisible = matchesClassification && matchesYear && matchesDate && matchesFullDate;
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

    // Ensure the fullDateFilter input always uses yyyy-mm-dd format
    const fullDateFilter = document.getElementById("fullDateFilter");
    fullDateFilter.addEventListener("change", (event) => {
        const formattedDate = formatDateToYYYYMMDD(event.target.value);
        fullDateFilter.value = formattedDate;
    });

    // Add a "NO RECORDS AVAILABLE" message element below the table
    const table = document.getElementById("productTable");
    const noRecordsMessage = document.createElement("div");
    noRecordsMessage.id = "noRecordsMessage";
    noRecordsMessage.textContent = "NO RECORDS AVAILABLE";
    noRecordsMessage.style.textAlign = "center";
    noRecordsMessage.style.color = "red";
    noRecordsMessage.style.fontSize = "40px";
    noRecordsMessage.style.marginTop = "10px";
    noRecordsMessage.style.display = "none"; // Initially hidden
    table.parentNode.insertBefore(noRecordsMessage, table.nextSibling);
});