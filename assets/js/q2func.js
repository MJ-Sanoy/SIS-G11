function filterTable() {
    const searchInput = document.getElementById("searchInput").value.trim().toLowerCase();
    const classificationFilter = document.getElementById("classificationFilter").value.toLowerCase();
    const storageFilter = document.getElementById("storageFilter").value.toLowerCase();
    const stockFilter = document.getElementById("stockFilter").value;
    const table = document.getElementById("productTable");
    const rows = table.getElementsByTagName("tr");
    const noRecordsMessage = document.getElementById("noRecordsMessage");

    let hasVisibleRows = false;

    for (let i = 1; i < rows.length; i++) {
        const productName = rows[i].getElementsByTagName("td")[0].textContent.trim().toLowerCase();
        const classification = rows[i].getElementsByTagName("td")[1].textContent.trim().toLowerCase();
        const storageLocation = rows[i].getElementsByTagName("td")[2].textContent.trim().toLowerCase();
        const stockCell = rows[i].getElementsByTagName("td")[3];
        const stock = parseInt(stockCell.textContent.trim(), 10);

        const matchesSearch = productName.includes(searchInput);
        const matchesClassification = classificationFilter === "" || classification === classificationFilter;
        const matchesStorage = storageFilter === "" || storageLocation === storageFilter;

        let matchesStock = true;
        if (stockFilter === "0") {
            matchesStock = stock === 0;
        } else if (stockFilter === "32") {
            matchesStock = stock > 0 && stock <= 32;
        } else if (stockFilter === "greater") {
            matchesStock = stock > 32;
        }

        const isVisible = matchesSearch && matchesClassification && matchesStorage && matchesStock;
        rows[i].style.display = isVisible ? "" : "none";

        if (isVisible) {
            hasVisibleRows = true;
        }

        // Apply color to the Number of Stocks column based on its value
        if (stock === 0) {
            stockCell.style.backgroundColor = "#c14545";
        } else if (stock > 0 && stock <= 32) {
            stockCell.style.backgroundColor = "#d8c14a"; 
        } else if (stock > 32) {
            stockCell.style.backgroundColor = "#349d7a";
        } else {
            stockCell.style.backgroundColor = "#EEEEEE";
        }
    }

    // Show or hide the "NO RECORDS AVAILABLE" message
    noRecordsMessage.style.display = hasVisibleRows ? "none" : "block";
}

// Function to populate classification filter dynamically
function populateClassificationFilter() {
    const table = document.getElementById("productTable");
    const rows = table.getElementsByTagName("tr");
    const classificationFilter = document.getElementById("classificationFilter");

    const classifications = new Set();
    for (let i = 1; i < rows.length; i++) {
        const classification = rows[i].getElementsByTagName("td")[1].textContent.trim();
        classifications.add(classification);
    }

    classificationFilter.innerHTML = '<option value="">All Classification</option>';
    classifications.forEach(classification => {
        const option = document.createElement("option");
        option.value = classification.toLowerCase();
        option.textContent = classification;
        classificationFilter.appendChild(option);
    });
}

// Function to populate storage filter dynamically
function populateStorageFilter() {
    const table = document.getElementById("productTable");
    const rows = table.getElementsByTagName("tr");
    const storageFilter = document.getElementById("storageFilter");

    const storageLocations = new Set();
    for (let i = 1; i < rows.length; i++) {
        const storageLocation = rows[i].getElementsByTagName("td")[2].textContent.trim();
        storageLocations.add(storageLocation);
    }

    storageFilter.innerHTML = '<option value="">All Stock Location</option>';
    storageLocations.forEach(storageLocation => {
        const option = document.createElement("option");
        option.value = storageLocation.toLowerCase();
        option.textContent = storageLocation;
        storageFilter.appendChild(option);
    });
}

// Attach event listeners for search, classification, storage, and stock filters
document.addEventListener("DOMContentLoaded", () => {
    document.getElementById("searchInput").addEventListener("input", filterTable);
    document.getElementById("classificationFilter").addEventListener("change", filterTable);
    document.getElementById("storageFilter").addEventListener("change", filterTable);
    document.getElementById("stockFilter").addEventListener("change", filterTable);

    populateClassificationFilter();
    populateStorageFilter();

    // Add a "NO RECORDS AVAILABLE" message element below the table
    const table = document.getElementById("productTable");
    const noRecordsMessage = document.createElement("div");
    noRecordsMessage.id = "noRecordsMessage";
    noRecordsMessage.textContent = "NO RECORDS AVAILABLE";
    noRecordsMessage.style.textAlign = "center";
    noRecordsMessage.style.color = "red";
    noRecordsMessage.style.fontSize = "40px";
    noRecordsMessage.style.marginTop = "10px";
    noRecordsMessage.style.display = "none";
    table.parentNode.insertBefore(noRecordsMessage, table.nextSibling);

    // Initial run
    filterTable();
});
