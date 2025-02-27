document.querySelectorAll('.editable').forEach(cell => {
    cell.addEventListener('blur', function () {
        let id = this.dataset.id;
        let column = this.dataset.column;
        let value = this.textContent;
        fetch('update_name.php', {
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