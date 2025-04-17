
document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("search-input");
    const tableBody = document.getElementById("table-body");
    const tableName = searchInput.getAttribute("data-table");

    searchInput.addEventListener("keyup", function () {
        const keyword = this.value;

        fetch(`search.php?table=${tableName}&keyword=${keyword}`)
            .then((res) => res.text())
            .then((data) => {
                tableBody.innerHTML = data;
            });
    });
});

