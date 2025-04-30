@extends('Admin.layout.master')

@section('admin-ui')
    <div class="row">
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body ">
                    <h4 class="card-title">Category Create form</h4>
                    <form class="forms-sample" action="{{ route('category.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputUsername1">Category Name</label>
                            <input type="text" name="name"
                                class="form-control @error('name')
                                is-invalid
                            @enderror"
                                id="exampleInputUsername1" placeholder="Enter Category Name" value="{{ old('name') }}">
                            @error('name')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Create</button>
                        <button type="reset" class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Recent Purchases</p>
                    {{ $categories->links() }}
                    <div class="table-responsive">
                        <table id="recent-purchases-listing" class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category Name</th>
                                    <th>Tools</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td class="">{{ $loop->iteration }}</td>
                                        <td class="">{{ $category->name }}</td>
                                        <td>
                                            <div class="row ">
                                                <div class="col-8 offset-2 d-flex justify-content-evenly">
                                                    <!-- Edit Button trigger modal -->
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#staticBackdrop-{{ $category->id }}">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="staticBackdrop-{{ $category->id }}"
                                                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">
                                                                        Edit Category </h1>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <form action="{{ route('category.update', $category->id) }}"
                                                                    method="post">
                                                                    @csrf @method('PUT')
                                                                    <div class="modal-body">
                                                                        <div class="form-group p-2">
                                                                            <label for="exampleInputUsername1">
                                                                                <h4>Category
                                                                                    Name</h4>
                                                                            </label>
                                                                            <input type="text" name="name"
                                                                                class="form-control @error('name')
                                                                                    is-invalid
                                                                                @enderror"
                                                                                id="exampleInputUsername1"
                                                                                placeholder="Enter Category Name"
                                                                                value="{{ old('name', $category->name) }}">
                                                                            @error('name')
                                                                                <small>{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit"
                                                                            class="btn btn-primary me-2">Update</button>
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- delete button  --}}
                                                    <form action="{{ route('category.destroy', $category->id) }}"
                                                        method="post">
                                                        @csrf @method('delete')
                                                        <button class="btn btn-danger text-light fw-bold"><i
                                                                class="mdi mdi-delete-forever"></i></button>
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
@endsection


