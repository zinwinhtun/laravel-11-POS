@extends('Admin.layout.master')

@section('admin-ui')
    <div class="row">
        {{-- user profile --}}
        <div class="col-md-4 grid-margin grid-margin-md-0 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">User Profile</h4>
                    {{-- user photo --}}
                    <img class="img-thumbnail" width="200px" height="200px"
                        src="{{ Auth::user()->profile != null ? asset('photo/' . Auth::user()->profile) || Auth::user()->profile : asset('photo/default-user.jpg') }}"
                        alt="profile" />
                    <ul class="list-ticked mt-4">
                        <li><strong> Name - </strong> {{ $user->name }}</li>
                        <li><strong> Nickname - </strong> {{ $user->nickname }}</li>
                        <li><strong> E-Mail - </strong> {{ $user->email }}</li>
                        <li><strong> Phone - </strong> {{ $user->phone }}</li>
                        <li><strong> Address - </strong> {{ $user->address }}</li>
                        <li><strong> Role - </strong> {{ $user->role }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md grid-margin grid-margin-md-0 stretch-card">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <h4 class="text-muted mt-2 col-4">Profile Setting</h4>
                        {{-- button group  --}}
                        <div class="col d-flex justify-content-end">
                            @if ($user->role == 'super admin')
                            <button class="btn btn-primary text-light me-4 ">Create Admin</button>
                            @endif
                            <a href="{{route('profile.edit')}}"><button class="btn btn-primary text-light me-4">Update Profile</button></a>

                            <a href="{{ route('keyword.change') }}"><button class="btn btn-primary text-light me-4">Change Password</button></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @yield('profile-setting')
                </div>
            </div>
        </div>
    </div>
@endsection
