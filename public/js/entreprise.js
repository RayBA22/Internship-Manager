

/* fonctions permettant de contrôler les ajouts/suppr des fenêtres du tableau de la liste
d'entreprises dans Entreprise.twig */



function toggleColumn(index) {
    var table = document.getElementById("dataTable");
    var columns = table.getElementsByTagName("th");
    var rows = table.getElementsByTagName("tr");

    columns[index].style.display = columns[index].style.display === "none" ? "" : "none";

    
    for (var i = 0; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName("td");
        if (cells[index]) {
            cells[index].style.display = cells[index].style.display === "none" ? "" : "none";
        }
    }

    
    updateDropdown();
}

function updateDropdown() {
    var table = document.getElementById("dataTable");
    var dropdown = document.getElementById("columnSelector");
    dropdown.innerHTML = ""; 
    var selectedColumns = [];

   
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


function addColumn() {
    var dropdown = document.getElementById("columnSelector");
    var selectedOption = dropdown.value;

    if (selectedOption !== "") {
        toggleColumn(parseInt(selectedOption)); 
    }
}


document.addEventListener("DOMContentLoaded", function() {
   
    for (var i = 5; i < 12; i++) {
        toggleColumn(i);
    }

    updateDropdown();
});
