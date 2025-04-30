@extends('Admin.layout.master')

@section('admin-ui')


{{-- {{dd($product->toArray())}} --}}

<div class="row">
    <div class="container">
        <div class="card">
            <div class="card-header">
              <h3 class="text-muted m-3" >Update Product</h3>
            </div>
            <div class="card-body">
                <div class="">
                    <img src="{{asset('photo/'.$product->image)}}" id="image" alt="product image" width="200px" height="200px">
                </div>
                <hr>
                {{-- update data form  --}}
                <div class="">
                    <form action="{{ route('product.update',$product->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf @method("PUT")
                    {{-- product name  --}}
                    <div class="row">
                        <div class="col-4">
                            <div class="form-floating mb-3">
                                <input type="name" name="name" class="form-control "
                                    id="floatingInput" placeholder="Something"
                                    value="{{old('name', $product->name)}}">
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
                                    value="{{ old('price', $product->price)}}">
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
                                    value="{{ old('stock', $product->stock) }}">
                                <label for="floatingInput">Stock</label>
                            </div>
                            @error('stock')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- Product Des  --}}
                    <div class="form-floating">
                        <textarea class="form-control" name="description" placeholder="Leave a comment here" id="floatingTextarea">{{ old('description', $product->description) }}</textarea>
                        <label for="floatingTextarea">Description</label>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    {{-- product category  --}}
                    <div class="row">
                        <div class="col mt-3">
                            <select name="category_id" class="form-control" id="">
                                @foreach ($category as $cate)
                                    <option value="{{ $cate->id }}" @if (old('category_id',$product->Category->id) == $cate->id) selected @endif>{{ $cate->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- image  --}}
                        <div class="col mt-3 mb-3">
                            <input type="hidden" value="{{$product->image}}">
                            <input type="file" name="image" value="" class="form-control form-control-sm"
                                onchange="loadFile(event)" accept="image/*">
                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{route('product.index')}}"><button type="button" class="btn btn-danger text-light me-3">Close</button></a>
                        <button type="submit" class="btn btn-primary text-light">Update</button>
                    </div>
                </form>
                </div>
            </div>
          </div>
    </div>
</div>

@endsection
