@extends('Admin.Template.Profile.index')

@section('profile-setting')
    <form action="{{route('admin.store')}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="row">
            {{-- name --}}
            <div class="col">
                <div class="form-group">
                    <label for="name">Username</label>
                    <input type="text" class="form-control" id="name" value="{{old('name')}}" name="name">
                    @error('name')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                  </div>
            </div>
            {{-- nickname --}}
            <div class="col">
                <div class="form-group">
                    <label for="nickname">Nickname</label>
                    <input type="text" class="form-control" id="nickname" value="{{old('nickname')}}" name="nickname">
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
                    <input type="email" class="form-control" id="email" value="{{old('email')}}" name="email">
                    @error('email')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                  </div>
            </div>
            {{-- phone  --}}
            <div class="col">
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="number" class="form-control" id="phone" value="{{old('phone')}}" name="phone">
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
                    <input type="text" class="form-control" id="Address" value="{{old('address')}}" name="address">
                    @error('address')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                  </div>
            </div>
            {{-- profile  --}}
            <div class="col">
                <div class="form-group">
                    <label for="profile">Profile</label>
                    <input type="file" class="form-control" id="profile" name="profile">
                    @error('profile')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                  </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                    @error('password')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                  </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="Confirm-password">Confirm Password</label>
                    <input type="password" class="form-control" id="Confirm-password" name="confirm-password">
                    @error('confirm-password')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                  </div>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <a href="{{route('profile.index')}}"><button class="btn btn-danger text-light me-3" type="button">CANCEL</button></a>
            <button class="btn btn-primary text-light" type="submit">CREATE</button>
        </div>
    </form>
@endsection
