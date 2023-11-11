        // Function to handle sort dropdown changes
        function handleSortChange() {
            // Get the selected sort option
            var sortDropdown = document.getElementById('sortDropdown');
            var selectedSort = sortDropdown.value;

            // Reload the page with the selected sort option as a query parameter
            window.location.href = window.location.pathname + '?sort=' + selectedSort;
        }