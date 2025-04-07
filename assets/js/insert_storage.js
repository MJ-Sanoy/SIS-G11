$(document).ready(function () {
    // Insert Storage Location
    $("#addStorageForm").off("submit").on("submit", function (event) {
        event.preventDefault();

        let newStorage = $("#new_storage").val().trim();

        if (newStorage === "") {
            Swal.fire({
                title: "Error",
                text: "Storage location cannot be empty.",
                icon: "error",
                background: "#444",
                color: "#fff",
                confirmButtonColor: "#b56cd9",
            });
            return;
        }

        Swal.fire({
            title: "Are you sure?",
            text: "Do you want to add this storage location?",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Yes, add it!",
            cancelButtonText: "Cancel",
            background: "#444",
            color: "#fff",
            confirmButtonColor: '#F7A511',
            cancelButtonColor: '#744491',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "insert_storage.php",
                    type: "POST",
                    data: { new_storage: newStorage },
                    dataType: "json",
                    success: function (response) {
                        console.log("AJAX Response:", response); // Debugging

                        if (response.success) {
                            Swal.fire({
                                title: "Success!",
                                text: "New storage location added successfully.",
                                icon: "success",
                                background: "#444",
                                color: "#fff",
                                confirmButtonColor: "#9b59b6"
                            });

                            let newRow = $(`<tr data-id="${response.id}" class="newly-added" style="display: none;">
                                <td style="text-align: center; font-weight: bold;">${response.id}</td>
                                <td contenteditable="true" class="editable" data-column="strg_location">${response.name}</td>
                                <td><button class="delete-button" data-id="${response.id}">Delete</button></td>
                            </tr>`);

                            $("#storageTable tbody").append(newRow);
                            newRow.fadeIn(1000);

                            $('html, body').animate({
                                scrollTop: newRow.offset().top
                            }, 800);

                            newRow.css({
                                "box-shadow": "0px 0px 10px 2px #b56cd9",
                                "transition": "box-shadow 2s ease-in-out"
                            });

                            setTimeout(() => {
                                newRow.css("box-shadow", "0px 0px 0px 0px");
                            }, 3000);

                            $("#new_storage").val(""); // Clear input field
                        } else {
                            Swal.fire({
                                title: "Error",
                                text: response.error,
                                icon: "error",
                                background: "#444",
                                color: "#fff",
                                confirmButtonColor: "#9b59b6"
                            });
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log("AJAX Error:", textStatus, errorThrown, jqXHR.responseText);
                        Swal.fire({
                            title: "Error",
                            text: "Something went wrong!",
                            icon: "error",
                            background: "#444",
                            color: "#fff",
                            confirmButtonColor: "#9b59b6"
                        });
                    },
                });
            }
        });
    });

    // Edit Storage Location
    $(document).on("blur", ".editable", function () {
        let id = $(this).closest("tr").data("id");
        let column = $(this).data("column");
        let value = $(this).text();

        $.ajax({
            url: "update_storage.php",
            method: "POST",
            data: { id: id, column: column, value: value },
            success: function (response) {
                console.log(response);
            },
        });
    });

    // Delete Storage Location
    $(document).on("click", ".delete-button", function () {
        let id = $(this).data("id");
        let row = $(this).closest("tr");

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            background: "#444", 
            color: "#fff", 
            confirmButtonColor: '#F7A511',
            cancelButtonColor: '#744491',
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                row.fadeOut(1000, function () {
                    $(this).remove();
                });

                $.ajax({
                    url: "delete_storage.php",
                    method: "POST",
                    data: { id: id },
                    success: function (response) {
                        Swal.fire({
                            title: "Deleted!",
                            text: "The storage location has been deleted.",
                            icon: "success",
                            background: "#444",
                            color: "#fff",
                            confirmButtonColor: "#9b59b6"
                        });
                    },
                });
            }
        });
    });
});
