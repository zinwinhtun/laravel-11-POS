@extends('Admin.layout.master')

@section('admin-ui')
    <div class="row">
        <div class="container">
            <div class="card border rounded-lg shadow-lg mb-3 mt-5 m-auto" style="max-width: 80%;">
                <div class="row no-gutters">
                  <div class="col-md-4">
                    <img class="p-2 shadow-sm" src="{{asset('/photo/'.$products->image)}}" width="300px" height="300px" alt="Product Image">
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <h5 class="card-title">{{$products->name}}</h5>
                      <h5><i class="mdi mdi-cash-usd me-2"></i>{{$products->price}}</h5>
                      <h5><i class="mdi mdi-layers me-2"></i>{{$products->stock}}</h5>
                      <p class="card-text"><strong>Category Name - </strong>{{$products->category->name}}</p>
                      <details>
                        <summary class="fs-6">Product Description</summary>
                        <p class="text-muted mt-4">{{$products->description}}</p>
                      </details>
                    </div>
                    <div class="d-flex justify-content-end me-4">
                        <a href="{{route('product.index')}}"><button class="btn btn-primary btn-rounded text-light shadow-sm">BACK</button></a>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
@endsection
