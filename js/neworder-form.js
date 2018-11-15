var orderItems = [];
var labEquipment;

$('#add-to-order').on('click', function(){
    let $itemsList = $('#items-list');
    let $itemNotAvl = $('#item-not-available');
    let $itemNotSeld = $('#item-not-seld');

    if($itemsList.val() == 0) {
        // Display error that admin must choose item
        $itemNotSeld.removeClass('hidden-element');
    } else {
        // Hide no item selected error
        $itemNotSeld.addClass('hidden-element');

        let itemIndex = findItemInOrder($itemsList.val());
        // Item isnt already in lab order
        if (itemIndex == -1) {
            // If theres at least one of selected item available
            if(labEquipment[$itemsList.val() - 1].available > 0) {
                // Add to order
                orderItems.push({item: labEquipment[$itemsList.val() - 1], quantity: 1})
                $('#order-items').val(JSON.stringify(orderItems));
                $('#order-items').change();


                // Assemble row
                let row = '<tr>'
                    + '<td>' + orderItems[orderItems.length - 1].item.description + '</td>'
                    + '<td>' + orderItems[orderItems.length -1].quantity + '</td>'
                    + '<td>'
                    + '<button type="button" class="btn btn-success btn-sm order-add">+</button>'
                    + '<button type="button" class="btn btn-danger btn-sm order-remove">-</button>'
                    + '</td>';

                // Add new row to summary
                let rows = $('#order-summary tbody').html();
                rows += row;
                $('#order-summary tbody').html(rows);

                //Hide none available error
                $itemNotAvl.addClass('hidden-element');
            } else {
                // Display there are no items of this kind available error.
                $itemNotAvl.removeClass('hidden-element');
            }
        // Item is in lab order
        } else {
            let countIncremented = incrementItemInOrder(itemIndex);
            if (!(countIncremented)) {
                // Display there are no items of this kind available error.
                $itemNotAvl.removeClass('hidden-element');
            } else {
                // Hide none available error
                $itemNotAvl.addClass('hidden-element');
            }
        }
    }
});

$(document).on('click', '#order-summary button', function(){
    let addOrRemove = $(this).index();  // Add if 0; Remove if 1;
    let itemIndex =  $(this).parent().parent().index();
    let $itemNotAvl = $('#item-not-available');

    if (addOrRemove == 0) {
        let itemIncremented = incrementItemInOrder(itemIndex);
        if(itemIncremented) {
            // Hide none available error
            $itemNotAvl.addClass('hidden-element');
        } else {
            // Display there are no items of this kind available error.
            $itemNotAvl.removeClass('hidden-element');
        }
    } else {
        decrementItemInOrder(itemIndex);
    }
});


function incrementItemInOrder(index) {
    if (orderItems[index].quantity < orderItems[index].item.available) {
        orderItems[index].quantity += 1;
        $('#order-summary tbody tr').eq(index).children().eq(1).html(orderItems[index].quantity);
        $('#order-items').val(JSON.stringify(orderItems));
        $('#order-items').change();

        return true;
    } else {
        return false;
    }
}


function decrementItemInOrder(index) {
    if (orderItems[index].quantity > 0) {
        orderItems[index].quantity -= 1;
        $('#order-summary tbody tr').eq(index).children().eq(1).html(orderItems[index].quantity);
        $('#order-items').val(JSON.stringify(orderItems));
        $('#order-items').change();


        // If quantity got to 0
        if (orderItems[index].quantity == 0) {
            // Remove from orderItems array
            orderItems.splice(index, 1);
            $('#order-items').val(JSON.stringify(orderItems));
            $('#order-items').change();

            // Remove from table
            $('#order-summary tbody tr').eq(index).remove();
        }
        return true;
    } else {
        return false;
    }
}

function findItemInOrder(item) {
    for (let i = 0; i < orderItems.length; i++) {
        if (orderItems[i].item.id == item) {
            return i;
        }
    }
    return -1;
}

$('#student-id').on('blur', function(){
    setCookie('userOrder', $(this).val());
});

$('#order-items').on('change', function(){
    setCookie('orderString', $(this).val());
});

// Get list of lab equipment from server
$(document).ready(function() {
    $.ajax({
        url: 'dataAccess/getLabEquipment.php',
        type: 'post',
        success: function(response) {
            // Populate combobox
            labEquipment = JSON.parse(response);
            let labEquipmentOptions = "<option value='0' selected>Elige...</option>";

            for (let i = 0; i < labEquipment.length; i++) {
                labEquipmentOptions +=
                    "<option value='" + labEquipment[i].id
                    + "'>" + labEquipment[i].description
                    + "</option>"
            }

            $('#items-list').html(labEquipmentOptions);
        }
    });

    let lastUser = getCookie('userOrder');
    let lastOrder = getCookie('orderString');

    if (lastUser != '') {
        $('#student-id').val(lastUser);
    }
    if (lastOrder != '') {
        $('#order-items').val(lastOrder);
        decodedOrder = JSON.parse(lastOrder);

        let rows = '';
        for (let i = 0; i < decodedOrder.length; i++) {
            rows += '<tr>'
                + '<td>' + decodedOrder[i].item.description + '</td>'
                + '<td>' + decodedOrder[i].quantity + '</td>'
                + '<td>'
                + '<button type="button" class="btn btn-success btn-sm order-add">+</button>'
                + '<button type="button" class="btn btn-danger btn-sm order-remove">-</button>'
                + '</td>';
        }
        $('#order-summary tbody').html(rows);


    }
});

function deleteOrderCookies() {
    let error = false;
    if($('#order-items').val() == '') {
        $('#empty-order').removeClass('hidden-element');
        error = true;
    } else {
        $('#empty-order').addClass('hidden-element');
    }

    if($('#student-id').val() == '') {
        $('#empty-id').removeClass('hidden-element');
        error = true;
    } else {
        $('#empty-id').addClass('hidden-element');
    }

    if (error) {
        return false;
    } else {
        deleteCookie('userOrder');
        deleteCookie('orderString');

        return true;
    }
}
