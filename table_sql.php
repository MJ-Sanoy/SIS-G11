<title style="color: white;">Main Table</title>
<style>
.filter-container {
    width: 100%;
    display: flex;
    flex-wrap: wrap; /* Allow wrapping for smaller screens */
    gap: 10px;
    margin: 10px auto -35px auto;
    justify-content: center; /* Center-align items */
}

.filter-container input,
.filter-container select,
#dateFilterButton,
#resetFilterButton {
    flex: 1 1 calc(25% - 20px); /* Responsive width: 4 items per row */
    min-width: 200px; /* Minimum width for smaller screens */
    padding: 8px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 4px;
    background-color: #756f91;
    color: #ffffff;
    text-align: center;
}

.filter-container input::placeholder {
    color: #ffffff;
}

#dateFilterButton, #resetFilterButton {
    background-color: #756f91;
    border: 1px solid #ccc;
    border-radius: 4px;
    color: #ffffff;
    font-weight: bold;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

#dateFilterButton:hover {
    background-color: #5a5073;
}

#resetFilterButton {
    background-color: indianred;
}

#resetFilterButton:hover {
    background-color: #b22222;
}

@media (max-width: 768px) {
    .filter-container input,
    .filter-container select,
    #dateFilterButton,
    #resetFilterButton {
        flex: 1 1 calc(50% - 20px); /* 2 items per row for smaller screens */
    }
}

@media (max-width: 480px) {
    .filter-container input,
    .filter-container select,
    #dateFilterButton,
    #resetFilterButton {
        flex: 1 1 100%; /* Full width for very small screens */
    }
}
</style>
<?php
include 'db_connect.php';

$classifications = [];
$classification_sql = "SELECT classification_id, c_name FROM c";
$classification_result = $conn->query($classification_sql);

if ($classification_result->num_rows > 0) {
    while ($classification_row = $classification_result->fetch_assoc()) {
        $classifications[] = $classification_row;
    }
}

$storage_locations = [];
$storage_sql = "SELECT storage_id, strg_location FROM strg";
$storage_result = $conn->query($storage_sql);

if ($storage_result->num_rows > 0) {
    while ($storage_row = $storage_result->fetch_assoc()) {
        $storage_locations[] = $storage_row;
    }
}

$classificationFilter = isset($_GET['classificationFilter']) ? intval($_GET['classificationFilter']) : null;
$storageFilter = isset($_GET['storageFilter']) ? intval($_GET['storageFilter']) : null;
$stockFilter = isset($_GET['stockFilter']) ? $_GET['stockFilter'] : null;
$dateFilterType = isset($_GET['dateFilterType']) ? $_GET['dateFilterType'] : null;
$dateFilterValue = isset($_GET['dateFilterValue']) ? $_GET['dateFilterValue'] : null;
$remarksFilter = isset($_GET['remarksFilter']) ? $_GET['remarksFilter'] : null;

$sql = "SELECT 
            p.product_id,
            stck.stck_id,
            p.name AS product_name,
            p.p_desc,
            c.c_name AS classification,
            strg.strg_location,
            stck.num_stck,
            d.date_delivered,
            stck.remarks
        FROM p
        LEFT JOIN c ON p.classification_id = c.classification_id
        LEFT JOIN stck ON p.product_id = stck.product_id
        LEFT JOIN d ON stck.date_id = d.date_id
        LEFT JOIN strg ON stck.storage_id = strg.storage_id
        WHERE 1=1";

if ($classificationFilter) {
    $sql .= " AND c.classification_id = $classificationFilter";
}

if ($storageFilter) {
    $sql .= " AND strg.storage_id = $storageFilter";
}

if ($stockFilter === "0") {
    $sql .= " AND stck.num_stck = 0";
} elseif ($stockFilter === "32") {
    $sql .= " AND stck.num_stck > 0 AND stck.num_stck <= 32";
} elseif ($stockFilter === "greater") {
    $sql .= " AND stck.num_stck > 32";
}

if ($dateFilterType && $dateFilterValue) {
    if ($dateFilterType === "year") {
        $sql .= " AND YEAR(d.date_delivered) = " . intval($dateFilterValue);
    } elseif ($dateFilterType === "month-year") {
        $sql .= " AND DATE_FORMAT(d.date_delivered, '%Y-%m') = '" . $conn->real_escape_string($dateFilterValue) . "'";
    } elseif ($dateFilterType === "day-month-year") {
        $sql .= " AND DATE(d.date_delivered) = '" . $conn->real_escape_string($dateFilterValue) . "'";
    }
}

if (isset($_GET['remarksFilter']) && $_GET['remarksFilter'] !== "") {
    $remarksFilter = $conn->real_escape_string($_GET['remarksFilter']);
    $sql .= " AND stck.remarks = '$remarksFilter'";
}

$result = $conn->query($sql);

// Fetch available years from the date_delivered column
$availableYears = [];
$yearQuery = "SELECT DISTINCT YEAR(date_delivered) AS year FROM d WHERE date_delivered IS NOT NULL ORDER BY year DESC";
$yearResult = $conn->query($yearQuery);

if ($yearResult->num_rows > 0) {
    while ($yearRow = $yearResult->fetch_assoc()) {
        $availableYears[] = $yearRow['year'];
    }
}
?>
<div class="filter-container">
    <input type="text" name="searchProduct" id="searchProduct" placeholder="Search Product Name" value="<?= htmlspecialchars($_GET['searchProduct'] ?? '') ?>">
    <input type="text" name="searchDescription" id="searchDescription" placeholder="Search Description" value="<?= htmlspecialchars($_GET['searchDescription'] ?? '') ?>">
    <select name="classificationFilter" id="classificationFilter">
        <option value="">All Classifications</option>
        <?php foreach ($classifications as $classification): ?>
            <option value="<?= $classification['classification_id'] ?>" <?= isset($_GET['classificationFilter']) && $_GET['classificationFilter'] == $classification['classification_id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($classification['c_name']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <select name="storageFilter" id="storageFilter">
        <option value="">All Storage Locations</option>
        <?php foreach ($storage_locations as $storage): ?>
            <option value="<?= $storage['storage_id'] ?>" <?= isset($_GET['storageFilter']) && $_GET['storageFilter'] == $storage['storage_id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($storage['strg_location']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <select name="stockFilter" id="stockFilter">
        <option value="">All Stocks</option>
        <option value="0" <?= isset($_GET['stockFilter']) && $_GET['stockFilter'] === "0" ? 'selected' : '' ?>>0 Stocks</option>
        <option value="32" <?= isset($_GET['stockFilter']) && $_GET['stockFilter'] === "32" ? 'selected' : '' ?>>Less than or equal to 32 Stocks</option>
        <option value="greater" <?= isset($_GET['stockFilter']) && $_GET['stockFilter'] === "greater" ? 'selected' : '' ?>>Greater than 32 Stocks</option>
    </select>
    <select name="remarksFilter" id="remarksFilter">
        <option value="">All Remarks</option>
        <option value="No available stock" <?= isset($_GET['remarksFilter']) && $_GET['remarksFilter'] === "No available stock" ? 'selected' : '' ?>>No available stock</option>
        <option value="Low stock" <?= isset($_GET['remarksFilter']) && $_GET['remarksFilter'] === "Low stock" ? 'selected' : '' ?>>Low Stock</option>
        <option value="In stock" <?= isset($_GET['remarksFilter']) && $_GET['remarksFilter'] === "In stock" ? 'selected' : '' ?>>In Stock</option>
    </select>
    <button id="dateFilterButton">Filter by Date Delivered</button>
    <button id="resetFilterButton">Reset</button>
</div>

<?php
if ($result->num_rows > 0) {
    echo "<div class='table-scroll-wrapper'>
            <table id='dataTable' class='product-table' border='1'>
            <thead>
                <tr class='table-header'>
                    <th class='table-heading'>Product ID</th>
                    <th class='table-heading'>Product Name</th>
                    <th class='table-heading'>Description</th>
                    <th class='table-heading'>Classification</th>
                    <th class='table-heading'>Storage Location</th>
                    <th class='table-heading'>Stock Number</th>
                    <th class='table-heading'>Date Delivered</th>
                    <th class='table-heading'>Remarks</th>
                    <th class='table-heading'>Action</th>
                </tr>
            </thead>
            <tbody>";

    while($row = $result->fetch_assoc()) {
        $remarks = ($row['num_stck'] == 0) ? 'No available stock' : (($row['num_stck'] <= 32) ? 'Low stock' : 'In stock');
        echo "<tr class='table-row'>
                <td class='table-cell' style='font-weight: bold;'>" . $row["product_id"] . "</td>
                <td class='table-cell editable' contenteditable='true' data-id='" . $row['product_id'] . "' data-column='name'>" . $row["product_name"] . "</td>
                <td class='table-cell editable' contenteditable='true' data-id='" . $row['product_id'] . "' data-column='p_desc'>" . $row["p_desc"] . "</td>
                <td class='table-cell'>
                    <select class='editable-dropdown' data-id='" . $row['product_id'] . "' data-column='classification_id'>";
                        foreach ($classifications as $classification) {
                            $selected = ($row['classification'] == $classification['c_name']) ? 'selected' : '';
                            echo "<option value='" . $classification['classification_id'] . "' $selected>" . $classification['c_name'] . "</option>";
                        }
        echo        "</select>
                </td>
                <td class='table-cell'>
                    <select class='editable-dropdown' data-id='" . $row['stck_id'] . "' data-column='storage_id'>";
                        foreach ($storage_locations as $storage) {
                            $selected = ($row['strg_location'] == $storage['strg_location']) ? 'selected' : '';
                            echo "<option value='" . $storage['storage_id'] . "' $selected>" . $storage['strg_location'] . "</option>";
                        }
        echo        "</select>
                </td>
                <td class='table-cell editable' contenteditable='true' data-id='" . $row['stck_id'] . "' data-column='num_stck'>" . $row["num_stck"] . "</td>
                <td class='table-cell'>
                    <input type='date' class='editable' data-id='" . $row['product_id'] . "' data-column='date_delivered' value='" . $row['date_delivered'] . "' />
                </td>
                <td class='table-cell' style='font-weight: bold;'>" . $remarks . "</td>
                <td class='table-cell'>
                    <a href='delete.php?id={$row['product_id']}' class='btn btn-delete'>Delete</a>
                </td>
            </tr>";
    }

    echo "</tbody></table></div>";
} else {
    echo "<p class='no-records'>No results found</p>";
}

$conn->close();
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="assets/js/tablescript.js"></script>
<script src="assets/js/table-sortmain.js"></script>
<script src="assets/js/scroll.js"></script>
<script src="assets/js/scroll-table.js"></script>
<script>
    document.getElementById("searchProduct").addEventListener("input", function () {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll("#dataTable .table-row");
        rows.forEach(row => {
            const productName = row.querySelector(".table-cell:nth-child(2)").textContent.toLowerCase();
            row.style.display = productName.includes(filter) ? "" : "none";
        });
    });

    document.getElementById("searchDescription").addEventListener("input", function () {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll("#dataTable .table-row");
        rows.forEach(row => {
            const description = row.querySelector(".table-cell:nth-child(3)").textContent.toLowerCase();
            row.style.display = description.includes(filter) ? "" : "none";
        });
    });

    document.getElementById("classificationFilter").addEventListener("change", function () {
        const classificationId = this.value;
        const url = new URL(window.location.href);
        if (classificationId) {
            url.searchParams.set("classificationFilter", classificationId);
        } else {
            url.searchParams.delete("classificationFilter");
        }
        window.location.href = url.toString();
    });

    document.getElementById("storageFilter").addEventListener("change", function () {
        const storageId = this.value;
        const url = new URL(window.location.href);
        if (storageId) {
            url.searchParams.set("storageFilter", storageId);
        } else {
            url.searchParams.delete("storageFilter");
        }
        window.location.href = url.toString();
    });

    document.getElementById("stockFilter").addEventListener("change", function () {
        const stockValue = this.value;
        const url = new URL(window.location.href);
        if (stockValue) {
            url.searchParams.set("stockFilter", stockValue);
        } else {
            url.searchParams.delete("stockFilter");
        }
        window.location.href = url.toString();
    });

    document.getElementById("remarksFilter").addEventListener("change", function () {
        const remarksValue = this.value;
        const url = new URL(window.location.href);
        if (remarksValue) {
            url.searchParams.set("remarksFilter", remarksValue);
        } else {
            url.searchParams.delete("remarksFilter");
        }
        window.location.href = url.toString();
    });

    const dateFilterButton = document.getElementById("dateFilterButton");
    const resetFilterButton = document.getElementById("resetFilterButton");

    dateFilterButton.addEventListener("click", () => {
        Swal.fire({
            title: '<span style="color: white;">Filter by Date Delivered</span>',
            html: `
                <div>
                    <button onclick="showFilter('year')" style="margin: 10px; padding: 10px; background-color: #756f91; color: white; border: none; border-radius: 4px;">Year</button>
                    <button onclick="showFilter('month-year')" style="margin: 10px; padding: 10px; background-color: #756f91; color: white; border: none; border-radius: 4px;">Month-Year</button>
                    <button onclick="showFilter('day-month-year')" style="margin: 10px; padding: 10px; background-color: #756f91; color: white; border: none; border-radius: 4px;">Day-Month-Year</button>
                </div>
                <div id="yearFilter" style="display: none; margin-top: 20px;">
                    <label for="yearSelect" style="color: white;">Year:</label>
                    <select id="yearSelect" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; background-color: #756f91; color: white;">
                        <option value="">Select Year</option>
                        <?php foreach ($availableYears as $year): ?>
                            <option value="<?= $year ?>"><?= $year ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div id="monthYearFilter" style="display: none; margin-top: 20px;">
                    <label for="monthYearInput" style="color: white;">Month-Year:</label>
                    <input type="month" id="monthYearInput" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; background-color: #756f91; color: white;">
                </div>
                <div id="dayMonthYearFilter" style="display: none; margin-top: 20px;">
                    <label for="dayMonthYearInput" style="color: white;">Day-Month-Year:</label>
                    <input type="date" id="dayMonthYearInput" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; background-color: #756f91; color: white;">
                </div>
            `,
            background: '#808080', /* Gray background */
            showCancelButton: true,
            confirmButtonText: 'Filter',
            preConfirm: () => {
                const yearFilter = document.getElementById("yearSelect").value;
                const monthYearFilter = document.getElementById("monthYearInput").value;
                const dayMonthYearFilter = document.getElementById("dayMonthYearInput").value;

                if (yearFilter) {
                    return { type: 'year', value: yearFilter };
                } else if (monthYearFilter) {
                    return { type: 'month-year', value: monthYearFilter };
                } else if (dayMonthYearFilter) {
                    return { type: 'day-month-year', value: dayMonthYearFilter };
                } else {
                    Swal.showValidationMessage('Please select a filter option');
                }
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const filterType = result.value.type;
                const filterValue = result.value.value;

                const url = new URL(window.location.href);
                url.searchParams.set("dateFilterType", filterType);
                url.searchParams.set("dateFilterValue", filterValue);
                window.location.href = url.toString();
            }
        });
    });

    resetFilterButton.addEventListener("click", () => {
        const url = new URL(window.location.href);
        url.searchParams.delete("classificationFilter");
        url.searchParams.delete("storageFilter");
        url.searchParams.delete("stockFilter");
        url.searchParams.delete("dateFilterType");
        url.searchParams.delete("dateFilterValue");
        url.searchParams.delete("remarksFilter");
        window.location.href = url.toString();
    });

    function showFilter(type) {
        const yearFilter = document.getElementById("yearFilter");
        const monthYearFilter = document.getElementById("monthYearFilter");
        const dayMonthYearFilter = document.getElementById("dayMonthYearFilter");

        yearFilter.style.display = "none";
        monthYearFilter.style.display = "none";
        dayMonthYearFilter.style.display = "none";

        if (type === "year") {
            yearFilter.style.display = "block";
        } else if (type === "month-year") {
            monthYearFilter.style.display = "block";
        } else if (type === "day-month-year") {
            dayMonthYearFilter.style.display = "block";
        }
    }
</script>