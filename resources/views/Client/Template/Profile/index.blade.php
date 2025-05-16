@extends('Client.Layout.main')

@section('main-ui')
    {{-- profile setting  --}}
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Profile Detail</h1>
    </div>
    <!-- Single Page Header End -->
    <div class="container my-4">
        <div class="row">
            {{-- user profile --}}
            <div class="col-lg-6">
                <div class="border rounded">
                    <a href="#">
                        <img src="{{$image}}" width="100%" class="img-fluid rounded" alt="Image">
                    </a>
                </div>
            </div>
            <div class="col-lg-6 m-auto text-center">
                <h4 class="fw-bold mb-3">{{$user->name}}</h4>
                <p class="mb-3">Nickname: {{$user->nickname}}</p>
                    <h5 class="fw-bold mb-3">{{$user->email}}</h5>
                <p class="mb-4">{{$user->phone}}</p>
                <p class="mb-4">{{$user->address}}</p>
                <a href="{{route('client')}}" class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary"><i
                        class="fa fa-home me-2 text-primary"></i> Back to Home</a>
                <a href="{{route('profile.edit')}}" class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary"><i
                        class="fa fa-edit me-2 text-primary"></i>Update Profile</a>
            </div>
        </div>
    </div>
@endsection
