@extends('Client.Layout.main')

@section('main-ui')
    <div class="container-fluid py-5 mt-5">
        <div class="container py-5 mt-3">
            <div class="row g-4 mb-5">
                <div class="col-lg-10 offset-1 col-xl-9">
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="border rounded">
                                <a href="#">
                                    <img src="{{ asset('photo/' . $product->image) }}" width="100%" height="450px"
                                        alt="Image">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h4 class="fw-bold mb-3">{{ $product->name }}</h4>
                            <p class="mb-3">Category: {{ $product->Category->name }}</p>
                            <h5 class="fw-bold mb-3">{{ $product->price }} MMK</h5>
                            <div class="d-flex mb-4">
                                {{-- show rating between 1 to 5  --}}
                                @for ($i = 1; $i <= $rating; $i++)
                                    <i class="fa fa-star text-secondary"></i>
                                @endfor

                                @for ($j = $rating + 1; $j <= 5; $j++)
                                    <i class="fa fa-star"></i>
                                @endfor

                            </div>
                            {{-- add to cart  --}}
                            <form action="{{ route('cart.addToCart') }}" class="d-inline" method="POST">
                                @csrf
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <div class="input-group quantity mb-5" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-minus rounded-circle bg-light border">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" name="qty" class="form-control form-control-sm text-center border-0"
                                        value="1">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-plus rounded-circle bg-light border">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <button type="submit" class=" btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary">
                                    <i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</button>
                            </form>
                            <!-- Rate Button  modal -->
                            <button type="button"
                                class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary"
                                data-bs-toggle="modal" data-bs-target="#staticRatingBackdrop-{{ $product->id }}">
                                <i class="fa fa-star"></i> Rate Product
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="staticRatingBackdrop-{{ $product->id }}" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form id="ratingForm" action="{{ route('rating') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-uppercase" id="staticBackdropLabel">Rate star
                                                    for
                                                    {{ $product->name }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <div class="rating">
                                                    <div class="star-icon">
                                                        @if ($userRating == 0)
                                                            <input type="radio" name="count" id="star1" checked
                                                                value="1">
                                                            <label for="star1">&#9733;</label>
                                                            <input type="radio" name="count" id="star2"value="2">
                                                            <label for="star2">&#9733;</label>
                                                            <input type="radio" name="count" id="star3"value="3">
                                                            <label for="star3">&#9733;</label>
                                                            <input type="radio" name="count" id="star4"value="4">
                                                            <label for="star4">&#9733;</label>
                                                            <input type="radio" name="count" id="star5"
                                                                value="5">
                                                            <label for="star5">&#9733;</label>
                                                        @else
                                                            @for ($i = 1; $i <= $userRating; $i++)
                                                                <input type="radio" checked name="count"
                                                                    id="star{{ $i }}"value="{{ $i }}">
                                                                <label for="star{{ $i }}">&#9733;</label>
                                                            @endfor
                                                            @for ($j = $userRating + 1; $j <= 5; $j++)
                                                                <input type="radio" name="count"
                                                                    id="star{{ $j }}"value="{{ $j }}">
                                                                <label for="star{{ $j }}">&#9733;</label>
                                                            @endfor
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger "
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary text-light">Submit
                                                    Rating</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!--Rate Modal end-->
                        </div>
                        <div class="col-lg-12">
                            <nav>
                                <div class="nav nav-tabs mb-3">
                                    <button class="nav-link active border-white border-bottom-0" type="button"
                                        role="tab" id="nav-about-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-about" aria-controls="nav-about"
                                        aria-selected="true">Description</button>
                                    <button class="nav-link border-white border-bottom-0" type="button" role="tab"
                                        id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission"
                                        aria-controls="nav-mission" aria-selected="false">Reviews <span
                                            class="badge bg-secondary">{{ count($comment) }}</span></button>

                                </div>
                            </nav>
                            <div class="tab-content mb-5">
                                <div class="tab-pane active" id="nav-about" role="tabpanel"
                                    aria-labelledby="nav-about-tab">
                                    <p>{{ $product->description }}</p>
                                    <div class="px-2">
                                        <div class="row g-4">
                                            <div class="col-6">
                                                <div
                                                    class="row bg-light align-items-center text-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Category</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0">{{ $product->Category->name }}</p>
                                                    </div>
                                                </div>
                                                <div
                                                    class="row text-center align-items-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Stock</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0">{{ $product->stock }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- {{dd($comment->toArray())}} --}}
                                {{-- comment list  --}}
                                <div class="tab-pane" id="nav-mission" role="tabpanel"
                                    aria-labelledby="nav-mission-tab">
                                    @foreach ($comment as $item)
                                        <div class="d-flex">
                                            @if (!filter_var($item->user->profile, FILTER_VALIDATE_URL))
                                                <img src="{{ asset($item->user->profile == null ? 'photo/default-user.jpg' : 'photo/' . $item->user->profile) }}"
                                                    class="img-fluid rounded-circle p-3"
                                                    style="width: 100px; height: 100px;" alt="">
                                            @else
                                                <img src="{{ $item->user->profile }}"
                                                    class="img-fluid rounded-circle p-3"
                                                    style="width: 100px; height: 100px;" alt="">
                                            @endif
                                            <div class="">
                                                <p class="mb-2" style="font-size: 14px;">
                                                    {{ $item->created_at->format('F j Y') }}</p>
                                                <div class="d-flex justify-content-between">
                                                    <h5>{{ $item->user->name }}</h5>
                                                    @if ($item->user->id == Auth::user()->id)
                                                        <div class="d-flex mb-3">
                                                            <button type="button"
                                                                onclick="deleteData({{ $item->id }})"
                                                                class="btn btn-sm btn-outline-danger ms-3"><i
                                                                    class="fa fa-trash text-outline-danger "></i> Delete
                                                                Comment</button>
                                                        </div>
                                                    @endif
                                                </div>
                                                <p>{{ $item->message }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="tab-pane" id="nav-vision" role="tabpanel">
                                    <p class="text-dark">Tempor erat elitr rebum at clita. Diam dolor diam ipsum et tempor
                                        sit. Aliqu diam
                                        amet diam et eos labore. 3</p>
                                    <p class="mb-0">Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et eos
                                        labore.
                                        Clita erat ipsum et lorem et sit</p>
                                </div>
                            </div>
                        </div>
                        {{-- review comment  --}}
                        <form action="{{ route('comment.save') }}" method="POST">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <h4 class="mb-5 fw-bold">Leave a Reply</h4>
                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <div class="border-bottom rounded">
                                        <input type="text" class="form-control border-0 me-4"
                                            value="{{ Auth::user()->name }}" readonly>

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="border-bottom rounded">
                                        <input type="email" class="form-control border-0" readonly
                                            value="{{ Auth::user()->email }}">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="border-bottom rounded my-4">
                                        <textarea name="message" id="" class="form-control border-0" cols="30" rows="8"
                                            placeholder="Your Review *" spellcheck="false"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit"
                                        class="btn btn-outline-secondary border border-secondary text-primary rounded-pill px-4 py-3">
                                        Post Comment</button>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <h1 class="fw-bold mb-0">Related products</h1>
        <div class="vesitable">
            <div class="owl-carousel vegetable-carousel justify-content-center">
                @foreach ($productList as $list)
                    <div class="border border-primary rounded position-relative vesitable-item">
                        <div class="vesitable-img" style="height: 200px">
                            <a href="{{ route('product.detail', $list->id) }}"><img
                                    src="{{ asset('photo/' . $list->image) }}" class="img-fluid w-100 rounded-top"
                                    alt=""></a>
                        </div>
                        <div class="text-white bg-primary px-3 py-1 rounded position-absolute"
                            style="top: 10px; right: 10px;">{{ $list->category->name }}</div>
                        <div class="p-4 pb-0 rounded-bottom">
                            <h4>{{ $list->name }}</h4>
                            <p>{{ Str::words($list->description, 5, '....') }}</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fw-bolder mt-1">{{ $list->price }} MMK</p>
                                <a href="#"
                                    class="btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary"><i
                                        class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    </div>
@endsection

@section('js-code')
    <script>
        //sweeet alert delete process
        function deleteData($id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your data has been deleted.",
                        icon: "success"
                    });

                    setInterval(() => {
                        location.href = '/client/comment/delete/' + $id
                    }, 1000);
                }
            });
        }
    </script>
@endsection
