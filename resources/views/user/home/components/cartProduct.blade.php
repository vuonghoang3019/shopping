<div class="cart-wrapper">
    <section id="cart_items" class="cart_item">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="active">Shopping Cart</li>
                </ol>
            </div>
            <div class="table-responsive cart_info">
                <table class="table table-condensed update_cart_url" data-url="{{ route('updateCart') }}">
                    <thead>
                    <tr class="cart_menu">
                        <td class="image">STT</td>
                        <td class="description">Name</td>
                        <td class="image">image</td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td>Action</td>
                    </tr>
                    </thead>

                    <tbody class="delete_cart_url" data-url="{{ route('deleteCart') }}">
                    @if($carts == null)
                        <tr>
                            <td colspan="7" class="text-center ">
                                No data
                            </td>
                        </tr>
                    @else
                        <?php $stt = 0;$total = 0; ?>
                        @foreach($carts as $id => $cart_item)
                            <?php $total += $cart_item['price'] * $cart_item['quantity'];?>
                            <tr>
                                <td class="cart_description">
                                    <h4><a href="">{{ $stt }}</a></h4>
                                </td>
                                <td class="cart_description">
                                    <h4><a href="">{{ $cart_item['name'] }}</a></h4>
                                </td>
                                <td class="cart_product">
                                    <a href=""><img src="{{ $cart_item['image'] }}" alt="" width="100" height="100"></a>
                                </td>
                                <td class="cart_price">
                                    <p>{{ number_format($cart_item['price']) }} VNĐ</p>
                                </td>
                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">
                                        <input class="cart_quantity_input" type="number" name="quantity" min="1"
                                               value="{{ $cart_item['quantity'] }}"
                                               autocomplete="off" size="2">
                                    </div>
                                </td>
                                <td class="cart_total">
                                    <p class="cart_total_price">{{ number_format($cart_item['price'] * $cart_item['quantity'])  }}
                                        VNĐ</p>
                                </td>
                                <td>
                                    <a class="btn btn-info cart_update" href="" data-id="{{ $id }}"><i
                                            class="fa fa-edit "></i></a>
                                    <a class="btn btn-danger cart_delete_product" href="" data-id="{{ $id }}"><i
                                            class="fa fa-times"></i></a>
                                </td>
                            </tr>
                            <?php $stt++; ?>
                        @endforeach
                    @endif
                    </tbody>
                    @if(isset($total))
                        <tr>
                            <th colspan="5"></th>
                            <th colspan="3">
                                <table class="table table-condensed total-result">
                                    <tr>
                                        <td>Cart Sub Total</td>
                                        <td>{{ number_format($total) }} VNĐ</td>
                                    </tr>
                                    <tr>
                                        <td>Exo Tax</td>
                                        <td>10.000 VNĐ</td>
                                    </tr>
                                    <tr class="shipping-cost">
                                        <td>Shipping Cost</td>
                                        <td>Free</td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td><span>{{ number_format($total + 10000) }} VNĐ </span></td>
                                    </tr>
                                </table>
                            </th>
                        </tr>
                    @endif
                    <tfoot>
                    </tfoot>
                </table>
            </div>
        </div>
    </section>
</div>


