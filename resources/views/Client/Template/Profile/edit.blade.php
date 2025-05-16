@extends('Client.Layout.main')

@section('main-ui')
    {{-- profile setting  --}}
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Profile Update</h1>
    </div>

    <div class="container mt-3">
        <div class="row">
            {{-- user profile --}}
            <div class="col-lg-6">
                <div class="border rounded">
                    <a href="#">
                        <img src="{{ $image }}" width="100%" height="500px" class="" id="image"
                            alt="Image">
                    </a>
                </div>
            </div>
            <div class="col-lg-6 m-auto text-center">
                <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    <p class="card-description">
                        Account info
                    </p>
                    <div class="row">
                        {{-- name --}}
                        <div class="col">
                            <div class="form-group">
                                <label for="name">Username</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name', Auth::user()->name) }}">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        {{-- nickname --}}
                        <div class="col">
                            <div class="form-group">
                                <label for="nickname">Nickname</label>
                                <input type="text" class="form-control" id="nickname" name="nickname"
                                    value="{{ old('nickname', Auth::user()->nickname) }}">
                                @error('nickname')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{-- email  --}}
                        <div class="col">
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email', Auth::user()->email) }}">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        {{-- phone  --}}
                        <div class="col">
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="number" class="form-control" id="phone" name="phone"
                                    value="{{ old('phone', Auth::user()->phone) }}">
                                @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{-- address  --}}
                        <div class="col">
                            <div class="form-group">
                                <label for="Address">Address</label>
                                <input type="text" class="form-control" id="Address" name="address"
                                    value="{{ old('address', Auth::user()->address) }}">
                                @error('address')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        {{-- profile  --}}
                        <div class="col">
                            <div class="form-group">
                                <label for="profile">Profile</label>
                                <input type="file" class="form-control" id="profile" name="profile"
                                    onchange="loadFile(event)" accept="image/*">
                                @error('profile')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('profile.index') }}"
                                class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary me-3"><i
                                    class="fa fa-house-user me-2 text-primary"></i> Back to Profile</a>
                            <button type="submit" href="{{ route('profile.edit') }}" class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary">
                                <i class="fa fa-save me-2 text-primary"></i>Save Profile</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection
