@extends('Admin.layout.master')

@section('admin-ui')
    {{-- {{dd($user->toArray())}} --}}
    <div class="row">
        <div class="card col-8 offset-2">
            <div class="card-header">
                <h4 class="card-title mt-3">Profile Information for <strong class="text-primary">{{ $user->name }} </strong>
                </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-4 offset-1">

                        <img class="" width="300px" height="300px"
                            src="{{ $user->profile ? (str_contains($user->profile, 'http') ? $user->profile : asset('photo/' . $user->profile)) : asset('photo/default-user.jpg') }}"
                            alt="profile" />

                    </div>
                    <div class="col ms-5">
                        <h3>Admin Information</h3>
                        <ul class="list-ticked mt-4">
                            <li><strong> Name - </strong> {{ $user->name }}</li>
                            @if ($user->nickname != null)
                                <li><strong> Nickname - </strong> {{ $user->nickname }}</li>
                            @endif
                            <li><strong> E-Mail - </strong> {{ $user->email }}</li>
                            <li><strong> Phone - </strong> {{ $user->phone }}</li>
                            <li><strong> Address - </strong> {{ $user->address }}</li>
                            <li><strong> Provider - </strong> {{ $user->provider }}</li>
                        </ul>
                        <hr>
                        <div class="d-flex  mt-4">
                            <a href="{{ route('user.list') }}" class="text-decoration-none">
                                <button class="btn btn-primary text-light">Back</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
