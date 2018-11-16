$(document).ready(function() {
    let options = {filter:'none'};
    loadOrders(options);
});

// Load all orders from database
function loadOrders(options) {
    $.ajax({
        data: options,
        url: 'dataAccess/getAllOrders.php',
        type: 'post',
        success: function(response) {
            // Populate table
            let userOrders = JSON.parse(response);
            let rows = '';

            for (let i = 0; i < userOrders.length; i++) {
                let tsArray = userOrders[i].timestamp.split(' ');
                let completed = '';
                if (userOrders[i].returned == 0) {
                    completed = 'Activo';
                } else {
                    completed = 'Cerrado';
                }
                rows += '<tr>'
                    + '<td>' + userOrders[i].id + '</td>'
                    + '<td>' + userOrders[i].student + '</td>'
                    + '<td>' + tsArray[0] + '</td>'
                    + '<td>' + completed + '</td>'
                    + '<td>' + '<a href="#">Ver mas</a>' + '</td>'
                    + '</tr>';
            }

            $('#student-orders tbody').html(rows);
        }
    });
}

// Load detailed view
$(document).on('click', '#student-orders tbody tr', function(){
    let orderIndex = $(this).index();  // Index of order in table
    let orderId = $(this).children().eq(0).html();  // id in db
    let orderUser = $(this).children().eq(1).html();
    let orderDate = $(this).children().eq(2).html();
    let orderSts = $(this).children().eq(3).html();

    // Display order info in detailed view
    $('#detailed-order-id').html(orderId);
    $('#detailed-order-student').html(orderUser);
    $('#detailed-order-date').html(orderDate);
    $('#detailed-order-status').html(orderSts);

    // Load items loaned in order
    let params = {orderId: orderId};
    loadLoans(params);
});

function loadLoans(params) {
    $.ajax({
        data: params,
        url: 'dataAccess/getOrderLoans.php',
        type: 'post',
        success: function(response) {
            // Populate table
            let orderLoans = JSON.parse(response);
            // console.log(orderLoans);
            $('#order-detailed').removeClass('hidden-element');
            let rows = '';

            for (let i = 0; i < orderLoans.length; i++) {
                let returned = '';
                let returnLink = '';
                if(orderLoans[i].returned == 0) {
                    returned = 'No';
                    returnLink = '<a href="#">Regresar articulo</a>';
                } else {
                    returned = 'Si';
                    returnLink = ' ';
                }

                rows += '<tr>'
                    + '<td>' + orderLoans[i].id + '</td>'
                    + '<td>' + orderLoans[i].description + '</td>'
                    + '<td>' + orderLoans[i].quantity + '</td>'
                    + '<td>' + orderLoans[i].dueDate + '</td>'
                    + '<td>' + returned + '</td>'
                    + '<td>' + returnLink + '</td>'
                    + '</tr>';
            }

            $('#order-items tbody').html(rows);
        }
    });
}

// Give item back
// Is actually triggered when row is clicked anywhere
$(document).on('click', '#order-items tbody tr', function(){
    let loanIndex = $(this).index();
    let loanId = $(this).children().eq(0).html();
    let params = {loanId: loanId};
    returnItem(loanIndex, loanId, params);
});

// Send request to return item
function returnItem(index, id, params) {
    $.ajax({
        data: params,
        url: 'dataAccess/returnItem.php',
        type: 'post',
        success: function(response) {
            let quantity = parseInt($('#order-items tbody').children().eq(index).children().eq(2).html());

            // If there where more than 0 of item, decrement count
            if (quantity > 0) {
                quantity--;
                $('#order-items tbody').children().eq(index).children().eq(2).html(quantity);
            }

            // If there are now 0 of item, mark item as returned
            if (quantity == 0){
                $('#order-items tbody').children().eq(index).children().eq(5).html(' ');
                $('#order-items tbody').children().eq(index).children().eq(4).html('Si');
            }
        }
    });
}
