@extends('Admin.Template.Profile.index')

@section('profile-setting')

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
                    <input type="text" class="form-control" id="name" name="name" value="{{old('name',Auth::user()->name) }}">
                    @error('name')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                  </div>
            </div>
            {{-- nickname --}}
            <div class="col">
                <div class="form-group">
                    <label for="nickname">Nickname</label>
                    <input type="text" class="form-control" id="nickname" name="nickname" value="{{old('nickname',Auth::user()->nickname) }}">
                    @error('nickname')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                  </div>
            </div>
        </div>
        <div class="row">
            {{-- email  --}}
            <div class="col">
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{old('email',Auth::user()->email) }}">
                    @error('email')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                  </div>
            </div>
            {{-- phone  --}}
            <div class="col">
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="number" class="form-control" id="phone" name="phone" value="{{old('phone', Auth::user()->phone)}}">
                    @error('phone')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                  </div>
            </div>
        </div>
        <div class="row">
             {{-- address  --}}
            <div class="col">
                <div class="form-group">
                    <label for="Address">Address</label>
                    <input type="text" class="form-control" id="Address" name="address" value="{{old('address',Auth::user()->address) }}">
                    @error('address')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                  </div>
            </div>
            {{-- profile  --}}
            <div class="col">
                <div class="form-group">
                    <label for="profile">Profile</label>
                    <input type="file" class="form-control" id="profile" name="profile" accept="image/*">
                    @error('profile')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                  </div>
            </div>
        </div>
        <div class="row">
            <div class="d-flex justify-content-end">
                <a href="{{route('profile.index')}}"><button type="button" class="btn btn-sm btn-danger text-light me-3 "> <small>CANCLE </small></button></a>
                <button type="submit" class="btn btn-sm btn-primary text-light "> <small>UPDATE</small></button>
            </div>
        </div>

</form>

@endsection
