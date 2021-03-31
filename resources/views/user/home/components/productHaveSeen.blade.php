<div class="producHaveSeen">
   <h2>SAN PHAM VUA XEM</h2>

</div>
@section('js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(function () {
            let renderProduct = '{{ route('productHaveSeen') }}';
            $(document).on('scroll', function () {
                if ($(window).scrollTop() > 400) {
                    console.log('scroll');
                    let products = localStorage.getItem('products');
                    products = $.parseJSON(products);
                    if (products.length > 0)
                    {
                        $.ajax({
                            url : renderProduct,
                            type : 'POST',
                            data : { id: products},
                            success: function (result) {
                                console.log(result);
                            }
                        });
                    }
                }
            })
        });
    </script>
@endsection
