function cartUpdate(event) {
    event.preventDefault();
    let urlUpdateCart = $('.update_cart_url').data('url');
    let id = $('.cart_update').data('id');
    let quantity = $(this).parents('tr').find('input.cart_quantity_input').val();
    $.ajax({
        type: "GET",
        url: urlUpdateCart,
        data: {id: id, quantity: quantity},
        success: function (data) {
            $('.cart-wrapper').html(data.cart_component);
        },
        error: function () {
            alert('error');
        }
    });
}

function cartDelete(event) {
    event.preventDefault();
    let urlDelete = $('.delete_cart_url').data('url');

    let id = $('.cart_delete_product').data('id');
    $.ajax({
        type: "GET",
        url: urlDelete,
        data: {id: id},
        success: function (data) {
            $('.cart-wrapper').html(data.cart_component);
        },
        error: function () {
            alert('error');
        }
    });
}

$(function () {
    $(document).on('click', '.cart_update', cartUpdate);
    $(document).on('click', '.cart_delete_product', cartDelete);
})
