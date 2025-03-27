$(document).ready(function () {
    $("#addClassificationForm").submit(function (event) {
        event.preventDefault();

        let newClassification = $("#new_classification").val().trim();

        if (newClassification === "") {
            Swal.fire({
                title: "Error",
                text: "Classification name cannot be empty.",
                icon: "error",
                background: "#444", 
                color: "#fff", 
                confirmButtonColor: "#b56cd9",
            });
            return;
        }

        Swal.fire({
            title: "Are you sure?",
            text: "Do you want to add this classification?",
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
                    url: "insert_classification.php",
                    type: "POST",
                    data: { new_classification: newClassification },
                    dataType: "json",
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                                title: "Success!",
                                text: "New classification added successfully.",
                                icon: "success",
                                background: "#444",
                                color: "#fff",
                                confirmButtonColor: "#9b59b6"
                            });

                            let newRow = $(`
                                <tr data-id="${response.id}" class="newly-added" style="display: none;">
                                    <td style="text-align: center; font-weight: bold;">${response.id}</td>
                                    <td contenteditable="true" class="editable" data-column="c_name">${response.name}</td>
                                    <td><button class="delete-button" data-id="${response.id}">Delete</button></td>
                                </tr>`);

                            $("#classificationTable tbody").append(newRow);

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

                            $("#new_classification").val("");
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
                    error: function () {
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

    $(document).on("blur", ".editable", function () {
        let id = $(this).closest("tr").data("id");
        let column = $(this).data("column");
        let value = $(this).text();

        $.ajax({
            url: "update_classification_name.php",
            method: "POST",
            data: { id: id, column: column, value: value },
            success: function (response) {
                console.log(response);
            },
        });
    });

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
                    url: "delete_classification.php",
                    method: "POST",
                    data: { id: id },
                    success: function (response) {
                        Swal.fire({
                            title: "Deleted!",
                            text: "The classification has been deleted.",
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
