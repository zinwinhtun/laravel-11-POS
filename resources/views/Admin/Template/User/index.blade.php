@extends('Admin.layout.master')

@section('admin-ui')
    <div class="row">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        {{-- page info  --}}
                        <div class="col-4">
                            <h4 class="card-title">User List</h4>
                            <p class="card-description">
                                Total User = <strong>{{ count($user) }}</strong>
                            </p>
                        </div>
                        {{-- search data  --}}
                        <div class="col-8 d-flex justify-content-end">
                            <form action="" method="get" class="w-25">
                                <input type="text" class="form-control border border-info rounded" name="user_data"
                                    placeholder="Enter User Search Data....">
                            </form>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User Name</th>
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
                                @foreach ($user as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->nickname }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->address }}</td>
                                        <td>{{ $user->provider }}</td>
                                        <td class="d-flex justify-content-evenly">
                                            {{-- user view btn  --}}
                                            <div class="">
                                                <a href="{{route('user.view',$user->id)}}">
                                                    <button class="btn btn-primary text-light">VIEW</button>
                                                </a>
                                            </div>
                                            {{-- user delete btn  --}}
                                            @if (!Auth::check() || Auth::user()->role == 'superadmin')
                                                <div class="">
                                                    <form action="{{route('user.delete',$user->id)}}" method="post" onsubmit="return confirm('Are you sure you want to delete this user?');">
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
