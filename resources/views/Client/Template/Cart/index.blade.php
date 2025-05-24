@extends('Client.Layout.main')
@section('main-ui')
    <!-- Cart Page Start -->
    <div class="container-fluid py-5 mt-5">
        <div class="container py-5 mt-3">
            <div class="table-responsive">
                <table class="table" id="cartTable">
                    <thead>
                        <tr>
                            <th scope="col">Products</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartData as $item)
                            <tr>
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('/photo/' . $item->product->image) }}"
                                            class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;"
                                            alt="">
                                    </div>
                                </th>
                                <td>
                                    <p class="mb-0 mt-4">{{ $item->product->name }}</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4 price">{{ $item->product->price }} MMK</p>
                                </td>
                                <td>
                                    <div class="input-group quantity mt-4" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm qty text-center border-0"
                                            value="{{ $item->qty }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4 total">{{ $item->Product->price * $item->qty }} MMK</p>
                                </td>
                                <td>
                                    <input type="hidden" class="cart_id" value="{{$item->id}}">
                                    <button class="btn btn-md rounded-circle bg-light border mt-4 btn-remove">
                                        <i class="fa fa-times text-danger"></i>
                                    </button>
                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="row g-4 justify-content-end">
                <div class="col-8"></div>
                <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                    <div class="bg-light rounded">
                        <div class="p-4">
                            <h1 class="display-6 mb-4">Total Bill</h1>
                            <div class="d-flex justify-content-between mb-4">
                                <h5 class="mb-0 me-4">Subtotal:</h5>
                                <p class="mb-0" id="subtotal">{{$total}} MMK</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="mb-0 me-4">TAX</h5>
                                <div class="">
                                    <p class="mb-0">1000 MMK</p>
                                </div>
                            </div>
                             <div class="mt-2">
                                    <p class="mb-0 fw-bold">Delievery fees depend on your location.</p>
                                </div>
                        </div>
                        <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                            <h5 class="mb-0 ps-4 me-4">Total</h5>
                            <p class="mb-0 pe-4">{{$total + 1000}} MMK</p>
                        </div>
                        <button class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4"
                            type="button">Proceed Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart Page End -->
@endsection

@section('js-code')
    <script>
        $(document).ready(function() {
            $('.btn-minus').click(function() {
                countCalculate(this);
                subTotal();
            })
            $('.btn-plus').click(function() {
                countCalculate(this);
                subTotal();
            })

            function countCalculate(e) {
                parent = $(e).parents("tr");
                price = parent.find('.price').text().replace("MMK", "");
                qty = parent.find('.qty').val();
                parent.find('.total').text(price * qty + " MMK");
            }

            // subtotal calculation
            function subTotal() {
                total = 0;
                $('#cartTable tbody tr').each(function(index, item) {
                total += Number($(item).find('.total').text().replace('MMK', ''));
                console.log(total);
                $('#subtotal').html(`${total} MMK`);
            })
            }

            //delete process
            $(".btn-remove").click(function(){
                parent = $(this).parents("tr"); // cache parent element
                cartId = parent.find('.cart_id').val(); //get cart id from parent element
                //set data
                deleteData = {
                    'cart_id' : cartId
                }

                $.ajax({
                    //api doc | url -> /client/delete | obj {cart_id : value}
                    type : "GET",
                    url : "/client/delete",
                    data : deleteData,
                    dataType : "json",
                    success : function(response){
                        //if delete success DOM refresh else still normal
                        response.status == 'success' ? location.reload() : '';
                    }
                })
            })
        })
    </script>
@endsection
