function AddToCard(event) {
    event.preventDefault();
    let urlCart = $(this).data('url');
    $.ajax({
        type: "GET",
        url: urlCart,
        dataType: 'json',
        success: function (data) {
            if (data.code === 201) {
                Swal.fire({
                    icon: 'error',
                    text: 'Add to cart fail',
                })
            }
            if (data.code === 200) {
                Swal.fire({
                    icon: 'success',
                    title: 'Oops...',
                    text: 'Add to cart complete',
                })
            }
        },
        error: function (data) {

        }
    })
}

function Check(event) {
    event.preventDefault();
    let urlCart = $(this).data('url');
    // $.ajax({
    //     type: "GET",
    //     url: urlCart,
    //     dataType: 'json',
    //     success: function (data) {
    //         if (data.code === 201) {
    //             Swal.fire({
    //                 icon: 'error',
    //                 text: 'Số lượng đã hết',
    //             })
    //         }
    //     },
    //     error: function () {
    //
    //     }
    // })
}

function AddToCartProductDetail(event) {
    event.preventDefault();
    let urlCart = $(this).data('url');
    let quantity = $('#num').val();
    // let quantity = $(this).parents('.product-information').find('input.cart_add').val();
    $.ajax({
        type: "GET",
        url: urlCart,
        data: {quantity: quantity},
        dataType: 'json',
        success: function (data) {
            if (data.code === 200) {
                Swal.fire({
                    icon: 'success',
                    title: 'Oops...',
                    text: 'Add to cart complete',
                })
            }
        },
        error: function () {

        }
    })
}

$(function () {
    $('.add-to-cart').on('click', AddToCard)
    $('.Checkquantity').on('click', Check)
    $('.add-to-cart-productDetail').on('click', AddToCartProductDetail)
})

