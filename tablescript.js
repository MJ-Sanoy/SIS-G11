document.querySelectorAll('.editable').forEach(cell => {
    cell.addEventListener('blur', function () {
        let id = this.dataset.id;
        let column = this.dataset.column;
        let value = this.textContent.trim();
        let url = "";

        if (column === "name") {
            url = "update_name.php";
        } else if (column === "p_desc") {
            url = "update_desc.php";
        } else if (column === "size") {
            url = "update_size.php";
        }

        if (url !== "") {
            fetch(url, {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `id=${id}&value=${encodeURIComponent(value)}`
            })
            .then(response => response.text())
            .then(data => {
                console.log(data);
                if (data.trim() === "success") {
                    alert("Data updated successfully");
                } else {
                    alert("Failed to update data");
                }
            });
        }
    });
});
