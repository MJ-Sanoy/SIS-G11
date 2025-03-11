// script for name and description
document.querySelectorAll('.editable').forEach(cell => {
    cell.addEventListener('blur', function () {
        let id = this.dataset.id;
        let column = this.dataset.column;
        let value = this.textContent.trim();
        let url = "";

        // Choose the PHP file based on the column name
        if (column === "name") {
            url = "update_name.php";
        } else if (column === "p_desc") {
            url = "update_desc.php";
        }

        if (url !== "") {
            fetch(url, {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `id=${id}&value=${encodeURIComponent(value)}`
            })
            .then(response => response.text())
            .then(data => {
                console.log(data);
                if (data.includes("success")) {
                    alert("Data updated successfully");
                } else {
                    alert("Failed to update data");
                }
            });
        }
    });
});
// script for classification dropdown
document.querySelectorAll('.editable-dropdown').forEach(select => {
    select.addEventListener('change', function () {
        let id = this.dataset.id;
        let column = this.dataset.column;
        let value = this.value;
        let url = "";

        if (column === "classification_id") {
            url = "update_classification.php";
        }

        if (url !== "") {
            fetch(url, {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `id=${id}&value=${encodeURIComponent(value)}`
            })
            .then(response => response.text())
            .then(data => {
                console.log(data);
                if (data.includes("success")) {
                    alert("Data updated successfully");
                } else {
                    alert("Failed to update data");
                }
            });
        }
    });
});
// script for storage dropdown
document.querySelectorAll('.editable-dropdown').forEach(select => {
    select.addEventListener('change', function () {
        let id = this.dataset.id; // This will now be stck_id
        let column = this.dataset.column;
        let value = this.value;

        fetch('update_storage.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `id=${id}&value=${encodeURIComponent(value)}`
        })
        .then(response => response.text())
        .then(data => {
            console.log(data);
            if (data.includes("success")) {
                alert("Data updated successfully");
            } else {
                alert("Failed to update data");
            }
        });
    });
});
// script for stock number 
$(document).on('blur', '.editable[data-column="num_stck"]', function () {
    var id = $(this).data('id');
    var value = $(this).text().trim();

    $.ajax({
        url: 'update_stock.php',
        type: 'POST',
        data: {
            id: id,
            value: value
        },
        success: function (response) {
            console.log("Sent ID: " + id);
            console.log("Sent Value: " + value);
            console.log("Server Response: " + response);
            if (response.trim() === "true") { // Fixed Response Check
                alert("Stock Number updated successfully!");
                location.reload();
            } else {
                console.log("Server Response: " + response);
                alert("Failed to update Stock Number");
            }
        },
        error: function (xhr, status, error) {
            console.log("AJAX Error: " + error);
            alert("Failed to update Stock Number");
        }
    });
});
// script for size
$(document).on('blur', '.editable[data-column="size"]', function () {
    var id = $(this).data('id');
    var value = $(this).text().trim();

    $.ajax({
        url: 'update_size.php', 
        type: 'POST',
        data: {
            id: id,
            value: value
        },
        success: function (response) {
            console.log("Sent ID: " + id);
            console.log("Sent Value: " + value);
            console.log("Server Response: " + response);
            if (response.trim() === "success") {
                alert("Size updated successfully!");
                location.reload();
            } else {
                alert("Failed to update Size");
            }
        }
    });
});
// script for date
$(document).on('change', '.editable[data-column="date_delivered"]', function () {
    var id = $(this).data('id');
    var value = $(this).val();

    $.ajax({
        url: 'update_date.php',
        type: 'POST',
        data: {
            id: id,
            value: value
        },
        success: function (response) {
            console.log("Sent ID: " + id);
            console.log("Sent Value: " + value);
            console.log("Server Response: " + response);
            if (response.trim() === "success") {
                alert("Date updated successfully!");
                location.reload();
            } else {
                console.log("Server Response: " + response);
                alert("Failed to update Date");
            }
        }
    });
});
// Delete
$(document).off('click', '.btn-delete').on('click', '.btn-delete', function (e) {
    e.preventDefault();
    var url = $(this).attr('href');
    var row = $(this).closest('tr');

    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
        customClass: {
            popup: 'gray-background' // Apply the gray-background class
        }
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: 'GET',
                success: function (response) {
                    console.log("Server Response: " + response);
                    if (response.trim().toLowerCase() === "success") {
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your data has been deleted.",
                            icon: "success",
                            customClass: {
                                popup: 'gray-background' // Apply the gray-background class
                            }
                        }).then(() => {
                            row.fadeOut(400, function () {
                                $(this).remove();
                            });
                        });
                    } else {
                        Swal.fire({
                            title: "Failed!",
                            text: "Your data was not deleted.",
                            icon: "error",
                            customClass: {
                                popup: 'gray-background' // Apply the gray-background class
                            }
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        title: "Oops!",
                        text: "Something went wrong!",
                        icon: "error",
                        customClass: {
                            popup: 'gray-background' // Apply the gray-background class
                        }
                    });
                }
            });
        }
    });
});
