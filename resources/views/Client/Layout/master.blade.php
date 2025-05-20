@extends('Client.Layout.main')
@section('main-ui')
    <!-- Fruits Shop Start-->
    <div class="container-fluid fruite py-5 mt-5">
        <div class="container py-5 mt-3">
            <div class="tab-class text-center">
                <div class="row g-4 mb-3">
                    <div class="col-lg-4 text-start text-muted">
                        <h1>Our Menu </h1>
                    </div>
                    <div class="col-lg-8 text-end d-flex justify-content-end">
                        {{-- categories filter  --}}
                        <div class="dropdown">
                            <a class="btn btn-secondary dropdown-toggle text-muted" href="#" role="button"
                                id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                Categorys Filter
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="{{ url('client/client') }}">All MENU</a></li>
                                @foreach ($categories as $cate)
                                    <li><a class="dropdown-item"
                                            href="{{ url('client/client?categoryId=' . $cate->id) }}">{{ $cate->name }}</a>
                                    </li>
                                @endforeach

                            </ul>
                        </div>

                        {{-- data sorting  --}}
                        <div class="dropdown ms-2">
                            <a  class="btn btn-secondary dropdown-toggle text-muted" href="#" role="button" id="dropdownMenuLink"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Menu Sorting
                            </a>

                            <ul name="sort" class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="{{ route('client', ['sort_by' => 'name', 'sort_order' => 'asc']) }}">A - Z</a></li>
                                <li><a class="dropdown-item" href="{{ route('client', ['sort_by' => 'name', 'sort_order' => 'desc']) }}">Z - A</a></li>
                                <li><a class="dropdown-item" href="{{ route('client', ['sort_by' => 'price', 'sort_order' => 'asc']) }}">price : Low - High</a></li>
                                <li><a class="dropdown-item" href="{{ route('client', ['sort_by' => 'price', 'sort_order' => 'desc']) }}">price : High - Low</a></li>
                                <li><a class="dropdown-item" href="{{ route('client', ['sort_by' => 'created_at', 'sort_order' => 'desc']) }}">Date : Latest - Oldest</a></li>
                                <li><a class="dropdown-item" href="{{ route('client', ['sort_by' => 'created_at', 'sort_order' => 'asc']) }}">Date : Oldest - Latest</a></li>
                            </ul>
                        </div>

                        <div class="ms-2">
                            {{-- product search  --}}
                            <form action="{{ route('client') }}" method="GET">
                                @csrf
                                <input type="text" class="form-control fs-smaller" name="searchProduct"
                                    placeholder="Search Products name..." value="{{ request('searchProduct') }}">
                            </form>
                        </div>
                    </div>
                </div>

                <div class="tab-content">

                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                            <div class="col-lg-12">

                                <div class="row g-4">
                                    {{-- product list  --}}
                                    @if (count($products) != 0)
                                        @foreach ($products as $item)
                                            <div class="col-md-6 col-lg-4 col-xl-3">
                                                <div class="rounded position-relative fruite-item">
                                                    <div class="fruite-img" style="height: 200px">
                                                        <a href="{{route('product.detail',$item->id)}}">
                                                            <img src="{{ asset('photo/' . $item->image) }}"
                                                            class="img-fluid w-100 rounded-top" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                                        style="top: 10px; left: 10px;">{{ $item->category->name }}</div>
                                                    <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                        <h4>{{ $item->name }}</h4>
                                                        <p>{{ Str::words($item->description, 5, '...') }}</p>
                                                        <div class="d-flex justify-content-center flex-lg-wrap">
                                                            <h4 class="text-dark  fw-bold mb-0">{{ $item->price }}MMK</h4>
                                                            <a href="#"
                                                                class="btn mt-2 border border-secondary rounded-pill px-3 text-primary"><i
                                                                    class="fa fa-shopping-bag me-2 text-primary"></i> Add to
                                                                cart</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="text-center text-muted mt-5">
                                            <h1>This Memu is coming soon. Thanks Your Choosing .</h1>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fruits Shop End-->
@endsection
