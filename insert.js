$(document).ready(function() {
    let newDataInserted = false; // Track if new data was inserted

    setTimeout(function() {
        if ($('#dataTable tbody').length === 0) {
            console.error("Table body not found!");
            Swal.fire('Error!', 'Table body not found!', 'error');
            return;
        }
    }, 500); // Delay by 500ms to allow the table to load

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

                        newDataInserted = true; // Mark that new data was inserted

                        Swal.fire({
                            title: 'Added!',
                            text: 'The data has been added.',
                            icon: 'success',
                            customClass: {
                                popup: 'gray-background'
                            }
                        }).then(() => {
                            $('.table').load('table_sql.php', function() {
                                var newElement = $('#dataTable tbody tr:last');
                                if (newElement.length) {
                                    $('html, body').animate({
                                        scrollTop: newElement.offset().top
                                    }, 1000, function() {
                                        newElement.css({'border': '3px solid green', 'transition': 'border 0.5s'});
                                        setTimeout(function() {
                                            newElement.css({'border': 'none'});
                                        }, 2000);
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

    // Ensure on page reload, it stays at the top unless new data was inserted
    $(window).on('load', function() {
        if (!newDataInserted) {
            $('html, body').scrollTop(0);
        }
    });
});
