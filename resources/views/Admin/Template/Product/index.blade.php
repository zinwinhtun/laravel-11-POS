@extends('Admin.layout.master')

@section('admin-ui')
    <div class="row">
        <div class="container">
            <div class="row">
                {{-- create product  --}}
                <div class="col">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary text-white" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        ADD PRODUCT
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create Product</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('product.store') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        {{-- product name  --}}
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-floating mb-3">
                                                    <input type="name" name="name" class="form-control "
                                                        id="floatingInput" placeholder="Something"
                                                        value="{{ old('name') }}">
                                                    <label for="floatingInput">Product Name</label>
                                                </div>
                                                @error('name')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            {{-- product Price  --}}
                                            <div class="col-4">
                                                <div class="form-floating mb-3">
                                                    <input type="number" name="price" class="form-control"
                                                        id="floatingInput" placeholder="name@example.com"
                                                        value="{{ old('price') }}">
                                                    <label for="floatingInput">Product Price</label>
                                                </div>
                                                @error('price')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            {{-- stock --}}
                                            <div class="col-4">
                                                <div class="form-floating mb-3">
                                                    <input type="number" name="stock" class="form-control"
                                                        id="floatingInput" placeholder="name@example.com"
                                                        value="{{ old('stock') }}">
                                                    <label for="floatingInput">Stock</label>
                                                </div>
                                                @error('stock')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- Product Des  --}}
                                        <div class="form-floating">
                                            <textarea class="form-control" name="description" placeholder="Leave a comment here" id="floatingTextarea">{{ old('description') }}</textarea>
                                            <label for="floatingTextarea">Description</label>
                                            @error('description')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        {{-- product category  --}}
                                        <div class="row">
                                            <div class="col mt-3">
                                                <select name="category_id" class="form-control" id="">
                                                    <option value="#" disabled>Select Category</option>
                                                    @foreach ($category as $cate)
                                                        <option value="{{ $cate->id }}"
                                                            @if (old('category_id') == $cate->id) selected @endif>
                                                            {{ $cate->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            {{-- image  --}}
                                            <div class="col mt-3 mb-3">
                                                <input type="file" name="image" class="form-control form-control-sm"
                                                    onchange="loadFile(event)" accept="image/*">
                                                @error('image')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <p>Upload Image</p>
                                            <div class="col-4 offset-4 mb-2">
                                                <img src="" alt="" id="image" width="200"
                                                    height="200">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger text-light me-3"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary text-light">Create</button>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col d-flex">
                    <h4 class="mt-2">Total Product = {{ count($product) }}</h4>
                    <a href="{{ route('product.limit') }}"><button class="btn btn-danger ms-3 text-light">Limit
                            Stock</button></a>
                    <a href="{{ route('product.index') }}"><button class="btn btn-primary text-light ms-3">All
                            Stock</button></a>
                    {{-- search  --}}
                    <div class="form-group ms-2 shadow-lg">
                        <div class="input-group">
                            <div class="input-group-prepend ">
                                <span class="input-group-text text-dark fw-bold"><i
                                        class="mdi mdi-keyboard-tab icon"></i></span>
                            </div>
                            <form action="" method="get">
                                <input type="text" name="searchData" value="{{ request('searchData') }}"
                                    class="form-control" placeholder="Search Here" aria-label="Username">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>
        <div class="">
            {{-- product table  --}}
            <div class="row">
                <div class="col-md-12 stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="row d-flex">
                                <p class="card-title">Product list</p>
                                <div class="">
                                    {{ $product->links() }}
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="recent-purchases-listing" class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Category</th>
                                            <th>Stock </th>
                                            <th>Tools</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- product list table  --}}
                                        @foreach ($product as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->price }} Kyats</td>
                                                <td>{{ $item->category->name }}</td>
                                                <td>{{ $item->stock }}
                                                    @if ($item->stock <= 5)
                                                        <small class="ms-3 text-danger">Stock Limit is Low</small>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-row justify-content-evenly ">
                                                        {{-- show button  --}}
                                                        <a class="text-decoration-none"
                                                            href="{{ route('product.show', $item->id) }}">
                                                            <button type="button"
                                                                class="btn btn-info btn-lg btn-block text-light p-2">View</button>
                                                        </a>
                                                        {{-- Edit button  --}}
                                                        <a href="{{route('product.edit',$item->id)}}">
                                                            <button class="btn btn-primary btn-lg btn-block text-light p-2 ">Edit</button>
                                                        </a>
                                                        {{-- delete button  --}}
                                                        <div class="">
                                                            <form action="{{ route('product.destroy', $item->id) }}"
                                                                method="post">
                                                                @csrf @method('delete')
                                                                <button class="btn btn-danger btn-lg btn-block text-light p-2">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- table end  --}}
        </div>
    </div>
@endsection
