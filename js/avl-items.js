$(document).ready(function() {
    // Load only available items
    let options = {filter:'avl'};
    loadItems(options);
});

function loadItems(options) {
    $.ajax({
        data: options,
        url: 'dataAccess/getAllItems.php',
        type: 'post',
        success: function(response) {
            // Populate table
            let avlItems = JSON.parse(response);
            let rows = '';

            for (let i = 0; i < avlItems.length; i++) {

                rows += '<tr>'
                    + '<td>' + avlItems[i].description + '</td>'
                    + '<td>' + avlItems[i].available + '</td>'
                    + '</tr>';
            }

            $('#avl-items tbody').html(rows);
        }
    });
}

// Filter
$(document).ready(function() {
    $("#filter-items").on("keyup", function() {
        let filterText = $(this).val().toLowerCase();
        $("#avl-items tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(filterText) > -1)
        });
    });
});
