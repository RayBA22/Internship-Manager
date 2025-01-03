// Function to toggle column visibility
function toggleColumn(index) {
    var table = document.getElementById("dataTable");
    var columns = table.getElementsByTagName("th");
    var rows = table.getElementsByTagName("tr");

    // Toggle visaibility of header column
    columns[index].style.display = columns[index].style.display === "none" ? "" : "none";

    // Toggle visibility of corresponding data cells
    for (var i = 0; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName("td");
        if (cells[index]) {
            cells[index].style.display = cells[index].style.display === "none" ? "" : "none";
        }
    }

    // Update the dropdown to reflect the current table state
    updateDropdown();
}

// Function to update the dropdown menu with hidden columns
function updateDropdown() {
    var table = document.getElementById("dataTable");
    var dropdown = document.getElementById("columnSelector");
    dropdown.innerHTML = ""; // Clear the current options
    var selectedColumns = [];

    // Get all column headers and check visibility
    var headers = table.querySelectorAll("th");
    for (var i = 0; i < headers.length; i++) {
        if (headers[i].style.display === "none") {
            var option = document.createElement("option");
            option.value = i;
            option.text = headers[i]. innerText.slice(0, -2);;
            dropdown.appendChild(option);
        }
    }
}

// Function to add selected column back to the table
function addColumn() {
    var dropdown = document.getElementById("columnSelector");
    var selectedOption = dropdown.value;

    if (selectedOption !== "") {
        toggleColumn(parseInt(selectedOption)); // Show the selected column
    }
}

// Initialize the table to show only the first 5 columns
document.addEventListener("DOMContentLoaded", function() {
    // Hide columns 6 to 13 initially
    for (var i = 5; i < 12; i++) {
        toggleColumn(i);
    }

    updateDropdown(); // Set initial dropdown values
});
