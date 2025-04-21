@extends('Admin.layout.link')
@section('link-to-master')
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
                <div class="row flex-grow">
                    <div class="col-lg-6 d-flex align-items-center justify-content-center">
                        <div class="auth-form-transparent text-left p-3">
                            <h4>Welcome!</h4>
                            <h6 class="font-weight-light">Happy to see you !</h6>
                            <form class="pt-3" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail">Email</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent border-right-0">
                                                <i class="mdi mdi-account-outline text-primary"></i>
                                            </span>
                                        </div>
                                        <input type="email" name="email" class="form-control form-control-lg border-left-0"
                                            id="exampleInputEmail" placeholder="Email" value="{{ old('email') }}">
                                    </div>
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword">Password</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent border-right-0">
                                                <i class="mdi mdi-lock-outline text-primary"></i>
                                            </span>
                                        </div>
                                        <input type="password" name="password" class="form-control form-control-lg border-left-0"
                                            id="exampleInputPassword" placeholder="Password">
                                    </div>
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="my-3">
                                    <button type="submit"
                                        class="btn btn-block btn-primary btn-lg text-light font-weight-medium auth-form-btn">LOGIN</button>
                                </div>
                                <div class="mb-2 d-flex">
                                    {{-- github login  --}}
                                    <a href="{{ route('social.login', 'github') }}"> <button type="button"
                                            class="btn btn-dark auth-form-btn flex-grow me-1">
                                            <i class="mdi mdi-github-box me-2"></i>Github
                                        </button></a>
                                    {{-- google login  --}}
                                    <a href="{{ route('social.login', 'google') }}"><button type="button"
                                            class="btn btn-google auth-form-btn flex-grow ms-1">
                                            <i class="mdi mdi-google me-2"></i>Google
                                        </button></a>
                                </div>
                                <div class="text-center mt-4 font-weight-light">
                                    Don't have an account? <a href="{{ route('register') }}"
                                        class="text-primary text-decoration-none text-dark fw-bold">Create</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 login-half-bg d-flex flex-row">
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
