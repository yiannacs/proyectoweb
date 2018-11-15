// var options = {};

$(document).ready(function() {
    let options = {filter:'none'};
    loadOrders(options);
});

function loadOrders(options) {
    $.ajax({
        data: options,
        url: 'dataAccess/getUserOrders.php',
        type: 'post',
        success: function(response) {
            // Populate table
            let userOrders = JSON.parse(response);
            let rows = '';

            for (let i = 0; i < userOrders.length; i++) {
                let tsArray = userOrders[i].timestamp.split(' ');
                let completed = '';
                if (userOrders[i].returned == 0) {
                    completed = 'Cerrado';
                } else {
                    completed = 'Activo';
                }
                rows += '<tr>'
                    + '<td>' + userOrders[i].id + '</td>'
                    + '<td>' + tsArray[0] + '</td>'
                    + '<td>' + completed + '</td>'
                    + '<td>' + '<a href="#">Ver mas</a>' + '</td>'
                    + '</tr>';

                $('#student-orders tbody').html(rows);
            }
        }
    });
}

$(document).on('click', '#student-orders tbody tr', function(){
    let orderIndex = $(this).index();  // Add if 0; Remove if 1;
    let orderId = $(this).children().eq(0).html();
    let orderDate = $(this).children().eq(1).html();
    let orderSts = $(this).children().eq(2).html();
    $('#detailed-order-id').html(orderId);
    $('#detailed-order-date').html(orderDate);
    $('#detailed-order-status').html(orderSts);

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
            console.log(orderLoans);
            $('#order-detailed').removeClass('hidden-element');
            let rows = '';

            // #order-items
            // <th scope="col">Articulo</th>
            // <th scope="col">Cantidad</th>
            // <th scope="col">Fecha de entrega</th>
            // <th scope="col">Regresado</th>

            // rows = '';
            for (let i = 0; i < orderLoans.length; i++) {

                let returned = '';
                if(orderLoans[i].returned == 0) {
                    returned = 'No';
                } else {
                    returned = 'Si';
                }

                rows += '<tr>'
                    + '<td>' + orderLoans[i].description + '</td>'
                    + '<td>' + orderLoans[i].quantity + '</td>'
                    + '<td>' + orderLoans[i].dueDate + '</td>'
                    + '<td>' + returned + '</td>'
                    + '</tr>';
            }

            $('#order-items tbody').html(rows);

            // for (let i = 0; i < userOrders.length; i++) {
            //     let tsArray = userOrders[i].timestamp.split(' ');
            //     let completed = '';
            //     if (userOrders[i].returned == 0) {
            //         completed = 'Cerrado';
            //     } else {
            //         completed = 'Activo';
            //     }
            //     rows += '<tr>'
            //         + '<td>' + userOrders[i].id + '</td>'
            //         + '<td>' + tsArray[0] + '</td>'
            //         + '<td>' + completed + '</td>'
            //         + '<td>' + '<a href="#">Ver mas</a>' + '</td>'
            //         + '</tr>';
            //
            //     $('#student-orders tbody').html(rows);
            // }
        }
    });
}
