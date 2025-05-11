@extends('Admin.layout.master')

@section('admin-ui')

    <div class="row">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        {{-- page info  --}}
                        <div class="col-4">
                            <h4 class="card-title">Admin List</h4>
                            <p class="card-description">
                                Total Admin = <strong>{{ count($admin) }}</strong>
                            </p>
                        </div>
                        {{-- search data  --}}
                        <div class="col-8 d-flex justify-content-end">
                            <form action="" method="get" class="w-25">
                                <input type="text" class="form-control border border-info rounded" name="adminData"
                                    placeholder="Enter Admin Search Data....">
                            </form>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Admin Name</th>
                                    <th>Nickname</th>
                                    <th>E-mail</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Channel</th>
                                    <th class="text-center">Tools</th>
                                </tr>
                            </thead>
                            {{-- admin tabel list  --}}
                            <tbody>
                                @foreach ($admin as $admin)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $admin->name }}</td>
                                        <td>{{ $admin->nickname }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td>{{ $admin->phone }}</td>
                                        <td>{{ $admin->address }}</td>
                                        <td>{{ $admin->provider }}</td>
                                        <td class="d-flex justify-content-evenly">
                                            {{-- admin view btn  --}}
                                            <div class="">
                                                <a href="{{ route('admin.show', $admin->id) }}">
                                                    <button class="btn btn-primary text-light">VIEW</button>
                                                </a>
                                            </div>
                                            {{-- admin delete btn  --}}
                                            @if (!Auth::check() || Auth::user()->id != $admin->id)
                                                <div class="">
                                                    <form action="{{route('admin.delete',$admin->id)}}" method="post" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                        @csrf @method('DELETE')
                                                        <button class="btn btn-danger text-light">DELETE</button>
                                                    </form>
                                                </div>
                                            @endif
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
