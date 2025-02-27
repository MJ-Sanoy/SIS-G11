document.querySelectorAll('.editable').forEach(cell => {
    cell.addEventListener('blur', function () {
        let id = this.dataset.id;
        let column = this.dataset.column;
        let value = this.textContent;
        updateData(id, column, value);
    });
});

function updateData(id, column, value) {
    fetch('update.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `id=${id}&column=${column}&value=${encodeURIComponent(value)}`
    })
    .then(response => response.text())
    .then(data => console.log(data));
}

function deleteRecord(id) {
    if (confirm("Are you sure you want to delete this?")) {
        fetch('delete.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `id=${id}`
        })
        .then(response => response.text())
        .then(data => {
            console.log(data);
            location.reload();
        });
    }
}