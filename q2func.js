// Function to filter table rows based on product name, classification, storage location, and stock range
function filterTable() {
    const searchInput = document.getElementById("searchInput").value.trim().toLowerCase();
    const classificationFilter = document.getElementById("classificationFilter").value.toLowerCase();
    const storageFilter = document.getElementById("storageFilter").value.toLowerCase();
    const stockFilterElement = document.querySelector('input[name="stockFilter"]:checked');
    const stockFilter = stockFilterElement ? stockFilterElement.value : "";
    const table = document.getElementById("productTable");
    const rows = table.getElementsByTagName("tr");

    for (let i = 1; i < rows.length; i++) { // Skip the header row
        const productName = rows[i].getElementsByTagName("td")[0].textContent.trim().toLowerCase();
        const classification = rows[i].getElementsByTagName("td")[1].textContent.trim().toLowerCase();
        const storageLocation = rows[i].getElementsByTagName("td")[2].textContent.trim().toLowerCase();
        const stock = parseInt(rows[i].getElementsByTagName("td")[3].textContent.trim(), 10);

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

        rows[i].style.display = matchesSearch && matchesClassification && matchesStorage && matchesStock ? "" : "none";
    }
}

// Function to populate classification filter dynamically
function populateClassificationFilter() {
    const table = document.getElementById("productTable");
    const rows = table.getElementsByTagName("tr");
    const classificationFilter = document.getElementById("classificationFilter");

    const classifications = new Set();
    for (let i = 1; i < rows.length; i++) { // Skip the header row
        const classification = rows[i].getElementsByTagName("td")[1].textContent.trim();
        classifications.add(classification);
    }

    classificationFilter.innerHTML = '<option value="">All</option>'; // Reset options
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
    for (let i = 1; i < rows.length; i++) { // Skip the header row
        const storageLocation = rows[i].getElementsByTagName("td")[2].textContent.trim();
        storageLocations.add(storageLocation);
    }

    storageFilter.innerHTML = '<option value="">All</option>'; // Reset options
    storageLocations.forEach(storageLocation => {
        const option = document.createElement("option");
        option.value = storageLocation.toLowerCase();
        option.textContent = storageLocation;
        storageFilter.appendChild(option);
    });
}

// Function to handle toggling of stock filter
function toggleStockFilter(event) {
    const radio = event.target;
    if (radio.checked && radio.dataset.toggled === "true") {
        radio.checked = false; // Uncheck the radio button
        radio.dataset.toggled = "false"; // Reset toggle state
        filterTable(); // Reapply the filter without stock filter
    } else {
        document.querySelectorAll('input[name="stockFilter"]').forEach(r => r.dataset.toggled = "false"); // Reset all toggles
        radio.dataset.toggled = "true"; // Mark the clicked radio as toggled
        filterTable(); // Apply the filter
    }
}

// Attach event listeners for search, classification, storage, and stock filters
document.addEventListener("DOMContentLoaded", () => {
    document.getElementById("searchInput").addEventListener("input", filterTable);
    document.getElementById("classificationFilter").addEventListener("change", filterTable);
    document.getElementById("storageFilter").addEventListener("change", filterTable);
    document.querySelectorAll('input[name="stockFilter"]').forEach(radio => {
        radio.addEventListener("click", toggleStockFilter);
        radio.dataset.toggled = "false"; // Initialize toggle state
        radio.checked = false; // Ensure no radio is selected by default
    });
    populateClassificationFilter();
    populateStorageFilter();
});