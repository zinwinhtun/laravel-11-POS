@extends('Client.Layout.main')

@section('main-ui')
    <div class="container-fluid py-5 mt-5">
        <div class="container py-5 mt-3">
            <h2 class="text-muted text-uppercase text-center">Contact Us</h2>
        </div>
        <div class="contact-form">
            <div class="row">
                <div class="col-6 offset-3">
                    <form action="{{route('mail.send')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                            <label for="exampleFormControlInput1" class="form-label">Email address <small class="text-danger">*** Optional</small> </label>
                            <input type="email" class="form-control" id="exampleFormControlInput1"
                                placeholder="name@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Title</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" name="title"
                                placeholder="Enter Title" value="{{old('title')}}">
                            @error('title')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="message">{{old('message')}}</textarea>
                             @error('message')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="text-end">
                            <button type="reset" class="btn btn-danger text-light">Delete</button>
                            <button type="submit" class="btn btn-primary text-light">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
