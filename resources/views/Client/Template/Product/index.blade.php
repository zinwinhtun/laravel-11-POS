@extends('Client.Layout.main')

@section('main-ui')
    <!-- Bestsaler Product Start -->
    <div class="container-fluid py-5 mt-5">
        <div class="container py-5 mt-3">
            <div class="text-center mx-auto mb-5" style="max-width: 700px;">
                <h1 class="display-4">Products Menu List</h1>
            </div>
            <div class="row g-4">
                @foreach ($products as $menu)
                    {{-- food menu container  --}}
                    <div class="col-lg-6 col-xl-4">
                        <div class="p-4 rounded bg-light">
                            <div class="row align-items-center">

                                <div class="col-6" style="height: 220px">
                                    <img src="{{ asset('photo/' . $menu->image) }}"
                                        class="img-fluid rounded-circle w-100 h-75" alt="">
                                </div>
                                <div class="col-6">
                                    <a href="#" class="h5">{{ $menu->name }}</a>
                                    <div class="d-flex my-3">
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <h4 class="mb-3">{{ $menu->price }} MMK</h4>
                                    <a href="{{ route('product.detail', $menu->id) }}"
                                        class="btn border border-secondary rounded-pill px-3 text-primary">
                                        <i class="fa fa-eye me-2 text-primary"></i> View Product</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Bestsaler Product End -->
@endsection
