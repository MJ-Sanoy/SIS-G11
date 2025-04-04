$(document).ready(function() {
    let newDataInserted = false;

    setTimeout(function() {
        if ($('#dataTable tbody').length === 0) {
            console.error("Table body not found!");
            Swal.fire('Error!', 'Table body not found!', 'error');
            return;
        }
    }, 500);

    $('#insertForm').on('submit', function(e) {
        e.preventDefault();
        var formData = $(this).serialize();

        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to add this data?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#F7A511',
            cancelButtonColor: '#744491',
            confirmButtonText: 'Yes, add it!',
            customClass: {
                popup: 'gray-background'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'insert.php',
                    method: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        console.log("Raw Response:", response);

                        if (response.error) {
                            Swal.fire('Error!', response.error, 'error');
                            return;
                        }

                        newDataInserted = true;

                        Swal.fire({
                            title: 'Added!',
                            text: 'The data has been added.',
                            icon: 'success',
                            background: "#222",
                            color: "#fff",
                            confirmButtonColor: "#9b59b6"
                        }).then(() => {
                            $('.table').load('table_sql.php', function() {
                                var newRow = $('#dataTable tbody tr:last');

                                if (newRow.length) {
                                    newRow.css({
                                        "opacity": "0",
                                        "transition": "opacity 1.5s ease-in-out"
                                    });

                                    setTimeout(() => {
                                        newRow.css("opacity", "1");
                                    }, 100);

                                    $('html, body').animate({
                                        scrollTop: newRow.offset().top
                                    }, 1000, function() {
                                        newRow.css({
                                            "box-shadow": "0px 0px 10px 4px #b56cd9", 
                                            "transition": "box-shadow 2s ease-in-out"
                                        });

                                        setTimeout(() => {
                                            newRow.css("box-shadow", "none"); 
                                        }, 3000);
                                    });
                                }
                            });
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error:", status, error);
                        Swal.fire('Error!', 'There was an error processing your request.', 'error');
                    }
                });
            }
        });
    });

    $(window).on('load', function() {
        if (!newDataInserted) {
            $('html, body').scrollTop(0);
        }
    });
});