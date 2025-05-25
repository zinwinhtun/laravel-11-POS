@extends('Client.Layout.main')

@section('main-ui')
    <div class="container-fluid py-5 mt-5">
        <div class="container py-5 mt-3">
            <h1>Payment process</h1>
            <hr>
            <div class="row p-2 border border-sm rounded shadow-sm">
                <div class="col-4">
                    <h5 class="text-muted text-center mb-5">Payment Methods</h5>
                    <p class="ps-3"><strong>Name</strong> : zin win htun</p>
                    <p class="ps-3"><strong>Account</strong> : zin win htun</p>
                    <hr>
                </div>
                {{-- payment form  --}}
                <div class="col-6 offset-1">
                    <form action="">
                        <div class="card">
                            <div class="card-header">
                                <p class="text-center text-uppercase">payment information</p>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <input type="text" class="form-control" placeholder="User Name">
                                    </div>
                                    <div class="col-4">
                                        <input type="number" class="form-control" placeholder="Phone">
                                    </div>
                                    <div class="col-4">
                                        <input type="text" class="form-control" placeholder="Address">
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-6">
                                        <select name="" id="" class="form-select">
                                            <option value="">Choose Payment Methods</option>
                                            <option value="">KBZ</option>
                                            <option value="">AYA</option>
                                            <option value="">WAVE</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <input type="file" class="form-control" placeholder="Phone">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <p>Order Coder : </p>
                                    </div>
                                    <div class="col">
                                        <p>Total Amount : 10000 MMK</p>
                                    </div>
                                </div>
                                <div class="row d-flex justify-content-center">
                                    <button class="btn btn-outline-primary w-50 "><i class="fa fa-cart-plus"></i> Order Now</button>
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
