@extends('Admin.layout.master')

@section('admin-ui')
    <div class="row">
        {{-- information  --}}
        <div class="col">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="mt-3 text-muted">Infromation</h4>
                    <a href="{{ route('order.list') }}" class="mt-3"><button>Back to list</button></a>
                </div>
                <div class="card-body">
                    <div class="row text-start">
                        <div class="col">
                            <p>Name : {{ $paymentHistory->user_name }}</p>
                            <p>Phone :{{ $paymentHistory->phone }}</p>
                            <p>Address :{{ $paymentHistory->address }}</p>
                        </div>
                        <div class="col">
                            <p>Order Code : <strong class="text-primary"
                                    id="orderCode">{{ $paymentHistory->order_code }}</strong></p>
                            <p>Order Date : {{ $paymentHistory->created_at->format('j-F-Y') }}</p>
                            <p>Total Price : {{ $paymentHistory->total_amount }} MMK <strong class="text-warning">Included
                                    TAX</strong></p>

                        </div>
                        <div class="col">
                            <p>Payment Method : {{ $paymentHistory->payment_method }}</p>
                            <img src="{{ asset('payment-slip/' . $paymentHistory->pay_slip) }}" alt="payment slip"
                                width="160px" height="240px">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="mt-2 text-muted">Order Board</h4>
                    <div>
                        @if ($outOfStock)
                            <button type="button" id="btn-accept" class="btn btn-success text-light ">Accept</button>
                        @endif
                        <button type="button" id="btn-reject" class="btn btn-danger text-light ">Reject</button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-responsive table-hover order-table">
                        <thead>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Order Count</th>
                            <th>Available Stock</th>
                            <th>Product Price</th>
                            <th>Total Price</th>
                        </thead>
                        <tbody>
                            @foreach ($order as $item)
                                <tr>
                                    <input type="hidden" name="" class="productId" value="{{ $item->product->id }}">
                                    <input type="hidden" name="" class="count" value="{{ $item->count }}">
                                    <td>
                                        <img src="{{ asset('photo/' . $item->product->image) }}" alt="">
                                    </td>
                                    <td>{{ $item->product->name }}</td>
                                    <td>{{ $item->count }}</td>
                                    <td>{{ $item->product->stock }} @if ($item->count >= $item->product->stock)
                                            <small class="text-danger">this product is out of stock</small>
                                        @endif
                                    </td>
                                    <td>{{ $item->product->price }} MMK</td>
                                    <td>{{ $item->product->price * $item->count }} MMK</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        $(document).ready(function() {

            //order reject
            $('#btn-reject').click(function() {
                orderCode = $('#orderCode').text();

                $.ajax({
                    type: "get",
                    url: '/admin/reject',
                    data: {
                        'order_code': orderCode
                    },
                    dataType: 'json',
                    success: function(res) {
                        res.status == 'success' ? location.href = "/admin/order" : '';
                    }
                })

            })

            //order accept
            $('#btn-accept').click(function() {
                orderCode = $('#orderCode').text();
                orderList = [];

                $('.order-table tbody tr').each(function(index, row) {
                    productId = $(row).find('.productId').val();
                    count = $(row).find('.count').val();

                    orderList.push({
                        'product_id': productId,
                        'count': count,
                        'order_code': orderCode
                    })
                })

                $.ajax({
                    type: "get",
                    url: '/admin/accept',
                    data: Object.assign ( {}, orderList),
                    dataType: 'json',
                    success: function(res){
                        res.status == 'success' ? location.href = "/admin/order" : '';
                    }
                })

            })
        })
    </script>
@endsection
