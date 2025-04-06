document.addEventListener("DOMContentLoaded", function () {
    const table = document.querySelector("#dataTable");

    // Create a wrapper for the table
    const tableWrapper = document.createElement("div");
    tableWrapper.style.overflowX = "auto";
    tableWrapper.style.width = "100%";

    // Create a top scrollbar container
    const topScrollBar = document.createElement("div");
    topScrollBar.style.overflowX = "auto";
    topScrollBar.style.width = "100%";

    // Create a dummy table for the top scrollbar
    const dummyTable = document.createElement("div");
    dummyTable.style.width = table.scrollWidth + "px";
    dummyTable.style.height = "1px";
    topScrollBar.appendChild(dummyTable);

    // Insert the top scrollbar above the table
    table.parentNode.insertBefore(topScrollBar, table);

    // Wrap the table in the bottom scroll wrapper
    table.parentNode.insertBefore(tableWrapper, table);
    tableWrapper.appendChild(table);

    // Synchronize scrolling between the top and bottom scrollbars
    topScrollBar.addEventListener("scroll", function () {
        tableWrapper.scrollLeft = topScrollBar.scrollLeft;
    });

    tableWrapper.addEventListener("scroll", function () {
        topScrollBar.scrollLeft = tableWrapper.scrollLeft;
    });

    // Function to toggle the horizontal wrapper based on screen width
    function toggleHorizontalWrapper() {
        const screenWidth = window.innerWidth;
        if (screenWidth > 768) {
            tableWrapper.style.overflowX = "hidden";
            topScrollBar.style.visibility = "hidden";
        } else {
            tableWrapper.style.overflowX = "auto";
            topScrollBar.style.visibility = "visible";
        }
    }

    // Initial check and add event listener for window resize
    toggleHorizontalWrapper();
    window.addEventListener("resize", toggleHorizontalWrapper);
});

