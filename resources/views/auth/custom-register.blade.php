@extends('Admin.layout.link')

@section('link-to-master')
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
                <div class="row flex-grow">
                    <div class="col-lg-9 d-flex align-items-center justify-content-center">
                        <div class="auth-form-transparent text-left">
                            <h4>New here?</h4>
                            <h6 class="font-weight-light">Join us today! It takes only few steps</h6>
                            {{-- register form  --}}
                            <form method="POST" action="{{ route('register') }}" class="pt-3">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        {{-- name --}}
                                        <div class="form-group ">
                                            <label>Username</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend bg-transparent">
                                                    <span class="input-group-text bg-transparent border-right-0">
                                                        <i class="mdi mdi-account-outline text-primary"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="name" value="{{ old('name') }}"
                                                    class="form-control form-control-lg border-left-0"
                                                    placeholder="Username">
                                            </div>
                                            @error('name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        {{-- phone  --}}
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend bg-transparent">
                                                    <span class="input-group-text bg-transparent border-right-0">
                                                        <i class="mdi mdi-email-outline text-primary"></i>
                                                    </span>
                                                </div>
                                                <input type="number" name="phone" value="{{ old('phone') }}"
                                                    class="form-control form-control-lg border-left-0" placeholder="Phone">
                                            </div>
                                            @error('phone')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- email --}}
                                <div class="form-group">
                                    <label>Email</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent border-right-0">
                                                <i class="mdi mdi-email-outline text-primary"></i>
                                            </span>
                                        </div>
                                        <input type="email" name="email" value="{{ old('email') }}"
                                            class="form-control form-control-lg border-left-0" placeholder="Email">
                                    </div>
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                {{-- password --}}
                                <div class="form-group">
                                    <label>Password</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent border-right-0">
                                                <i class="mdi mdi-lock-outline text-primary"></i>
                                            </span>
                                        </div>
                                        <input type="password" name="password"
                                            class="form-control form-control-lg border-left-0" id="exampleInputPassword"
                                            placeholder="Password">
                                    </div>
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                {{-- confirm password --}}
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent border-right-0">
                                                <i class="mdi mdi-lock-outline text-primary"></i>
                                            </span>
                                        </div>
                                        <input type="password" name="password_confirmation"
                                            class="form-control form-control-lg border-left-0" id="exampleInputPassword"
                                            placeholder="Password">
                                    </div>
                                    @error('password_confirmation')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mt-3">
                                    <button type="submit"
                                        class="btn btn-block btn-primary btn-lg font-weight-medium text-light auth-form-btn">
                                        SIGN IN
                                    </button>
                                </div>
                                <div class="text-center mt-4 font-weight-light">
                                    Already have an account? <a href="{{ route('login') }}"
                                        class="text-primary text-decoration-none text-dark fw-bold">Login</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-3 register-half-bg d-flex flex-row">
                        <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy; 2020
                            All rights reserved.</p>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
@endsection
