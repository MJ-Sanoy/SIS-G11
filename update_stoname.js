$(document).ready(function () {
    // Handle contenteditable changes
    $('.editable').on('blur', function () {
        const id = $(this).closest('tr').data('id');
        const column = $(this).data('column');
        const value = $(this).text();

        // Send AJAX request to update the database
        $.ajax({
            url: 'update_storage_name.php',
            type: 'POST',
            data: { id: id, column: column, value: value },
            success: function (response) {
                console.log("Sent ID: " + id);
                console.log("Sent Value: " + value);
                console.log("Server Response: " + response);

                // Check if the response contains success
                if (response.trim().toLowerCase().includes("record updated successfully")) {
                    Swal.fire({
                        title: "Success!",
                        text: "Storage location updated successfully!",
                        icon: "success",
                        customClass: {
                            popup: 'gray-background'
                        }
                    }).then(() => location.reload());
                } else {
                    Swal.fire({
                        title: "Error!",
                        text: "Failed to update storage location.",
                        icon: "error",
                        customClass: {
                            popup: 'gray-background'
                        }
                    });
                }
            },
            error: function () {
                Swal.fire({
                    title: "Error!",
                    text: "An unexpected error occurred.",
                    icon: "error",
                    customClass: {
                        popup: 'gray-background'
                    }
                });
            },
        });
    });

    // Handle form submission for adding new storage locations
    $('#addStorageForm').on('submit', function (e) {
        e.preventDefault();
        const newStorage = $('#new_storage').val();

        // Send AJAX request to insert the new storage location
        $.ajax({
            url: 'insert_storage.php',
            type: 'POST',
            data: { new_storage: newStorage },
            success: function (response) {
                console.log("Server Response: " + response);

                // Check if the response contains success
                if (response.trim().toLowerCase().includes("record inserted successfully")) {
                    Swal.fire({
                        title: "Success!",
                        text: "New storage location added successfully!",
                        icon: "success",
                        customClass: {
                            popup: 'gray-background'
                        }
                    }).then(() => location.reload());
                } else {
                    Swal.fire({
                        title: "Error!",
                        text: "Failed to add new storage location.",
                        icon: "error",
                        customClass: {
                            popup: 'gray-background'
                        }
                    });
                }
            },
            error: function () {
                Swal.fire({
                    title: "Error!",
                    text: "An unexpected error occurred.",
                    icon: "error",
                    customClass: {
                        popup: 'gray-background'
                    }
                });
            },
        });
    });
});
