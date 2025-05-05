@extends('Admin.Template.Profile.index')

@section('profile-setting')
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
            <div class="d-flex justify-content-evenly">
                <a href="{{route('profile.index')}}"><button type="button" class="btn btn-danger text-light">Cencel</button></a>
                <button type="submit" class="btn btn-primary text-light" style="width: 150px">Submit</button>
            </div>
        </form>
    </div>
@endsection
