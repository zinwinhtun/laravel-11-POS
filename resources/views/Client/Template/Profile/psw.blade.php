@extends('Client.Layout.main')

@section('main-ui')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Password Change</h1>
    </div>
    <div class="row mt-4">
        <div class="container col-8 offset-2">
            <div class="w-50 m-auto">
        <h5 class="card-title text-muted">Change Your New Password</h5>
        {{-- password change form  --}}
        <form action="{{ route('keyword.save') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="text-muted" for="currentPassword">Current Password</label>
                <input type="password" value="{{ old('oldPassword') }}" name="oldPassword" class="form-control"
                    id="currentPassword">
                @error('oldPassword')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label class="text-muted" for="NewPassword">New Password</label>
                <input type="password" value="{{ old('newPassword') }}" name="newPassword" class="form-control"
                    id="NewPassword">
                @error('newPassword')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label class="text-muted" for="confirmPassword">Confirm Password</label>
                <input type="password" value="{{ old('confirmPassword') }}" name="confirmPassword" class="form-control"
                    id="confirmPassword">
                @error('confirmPassword')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="d-flex justify-content-center mt-3">
                <a href="{{route('profile.index')}}"><button type="button" class="btn btn-danger text-light me-3">Cencel</button></a>
                <button type="submit" class="btn btn-primary text-light" style="width: 150px">Submit</button>
            </div>
        </form>
    </div>
        </div>
    </div>
@endsection
