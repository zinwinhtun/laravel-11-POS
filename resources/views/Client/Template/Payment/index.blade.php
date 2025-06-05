@extends('Client.Layout.main')

@section('main-ui')
    <div class="container-fluid py-5 mt-5">
        <div class="container py-5 mt-3">
            <h1>Payment process</h1>
            <hr>
            <div class="row p-2 border border-sm rounded shadow-sm">
                <div class="col-4">
                    <h5 class="text-muted text-center mb-3">Payment Methods</h5>
                    <form action="" method="POST">
                        @csrf
                        <label for="payment_method" class="ps-3 mb-2">Select Payment Methods</label>
                        <select name="" id="payment_method" class="form-select">
                            <option value="">Choose Payment Methods</option>
                            @foreach ($methods as $method)
                                <option value="{{ $method }}">{{ $method }}</option>
                            @endforeach
                        </select>
                    </form>
                    <p class="ps-3 mt-3"><span>Name</span> : <strong class="accountName"></strong> </p>
                    <p class="ps-3"><strong>Account Number</strong> : <strong class="accountNumber"></strong> </p>
                    <hr>

                </div>
                {{-- payment form  --}}
                <div class="col-6 offset-1 text-center">
                    <form action="{{route('order.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <p class="text-center text-uppercase">payment information</p>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <input type="text" class="form-control" readonly name="name"
                                            value="{{ Auth::user()->name }}">
                                    </div>
                                    <div class="col-6">
                                        <input type="number" name="phone" value="{{old('phone')}}" class="form-control" placeholder="Enter Phone Number ">
                                        @error('phone')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>

                                </div>
                                <div class="row my-3">
                                    <div class="col-6">
                                        <select name="payment_methods" class="form-select">
                                            <option value="">Whic Payment You Choose</option>
                                            @foreach ($methods as $method)
                                                <option value="{{$method}}" @if (old('payment_methods') == $method) selected @endif>{{$method}}</option>
                                            @endforeach
                                        </select>
                                        @error('payment_methods')
                                            <small class="text-danger ">{{$message}}</small>
                                        @enderror
                                    </div>
                                    {{-- <div class="col-6">

                                    </div> --}}
                                    <div class="col-6">
                                        <input type="file" class="form-control" name="pay_slip">
                                        @error('pay_slip')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <textarea name="address" id="" class="form-control" cols="30" rows="3" placeholder="Enter Your address">{{old('address')}}</textarea>
                                        @error('address')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input type="hidden" name="orderCode" value="{{$orderCode[0]['order_code']}}">
                                        <p>Order Coder : <span class="text-primary fw-bold">{{$orderCode[0]['order_code']}}</span></p>
                                    </div>
                                    <div class="col">
                                        <input type="hidden" name="total_amount" value="{{$orderCode[0]['totalAmt']}}">
                                        <p>Total Amount : {{$orderCode[0]['totalAmt']}} MMK</p>
                                    </div>
                                </div>
                                <div class="row d-flex justify-content-center">
                                    <button type="submit" class="btn btn-outline-primary w-50 "><i class="fa fa-cart-plus"></i> Order
                                        Now</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                {{-- payment form end  --}}
            </div>
            <div class="text-center mt-5 mb-0">
                <h1 class="text-primary">Thank You For Your Order,Enjoy Your Beautiful Day...</h1>
            </div>
        </div>
    </div>
@endsection

@section('js-code')
    <script>
        $('#payment_method').on('change', function() {
            paymentMethod = $(this).val();

            dataMethod = {
                'payment_method': paymentMethod,
                _token: '{{ csrf_token() }}'
            }

            $.ajax({
                url: '/client/get-payment-info',
                type: 'POST',
                data: dataMethod,
                dataType : "json",
                success: function (response) {
                    $('.accountName').text(response.name);
                    $('.accountNumber').text(response.number);
                },
                 error: function () {
                    alert('Something went wrong!');
                }

            });
        })
    </script>
@endsection
