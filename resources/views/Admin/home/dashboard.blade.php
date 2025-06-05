@extends('Admin.layout.master')

@section('admin-ui')

    <div class="row text-center">
        {{-- total Revenue --}}
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <i class="mdi mdi-trophy h1" style="color: gold"></i>
                    <h4 class="mt-2 text-primary">TOTAL SALE</h4>
                </div>
                <div class="card-body">
                    <h3>{{$totalSale}} MMK</h3>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <i class="mdi mdi-account-multiple h1 text-success"></i>
                    <h4 class="mt-2 text-primary">TOTAL USER</h4>
                </div>
                <div class="card-body">
                    <h3><a href="{{route('user.list')}}" class="text-decoration-none text-dark">{{$user}}</a></h3>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <i class="mdi mdi-account-star h1 text-success"></i>
                    <h4 class="mt-2 text-primary">TOTAL ADMIN</h4>
                </div>
                <div class="card-body">
                    <h3><a href="{{route('admin.list')}}" class="text-decoration-none text-dark">{{$admin}}</a></h3>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <i class="mdi mdi-cart h1 text-info"></i>
                    <h4 class="mt-2 text-primary">TOTAL ORDER</h4>
                </div>
                <div class="card-body">
                    <h3><a href="{{route('order.list')}}" class="text-decoration-none text-dark">{{$order}}</a></h3>
                </div>
            </div>
        </div>
    </div>

@endsection
