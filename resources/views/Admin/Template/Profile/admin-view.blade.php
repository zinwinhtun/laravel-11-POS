@extends('Admin.layout.master')

@section('admin-ui')
<div class="row">
    <div class="card col-8 offset-2">
        <div class="card-header">
            <h4 class="card-title mt-3">Profile Information for <strong class="text-primary">{{$adminProfile->name}} </strong></h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4 offset-1">
                     <img class="" width="300px" height="300px" src="{{$image}}" alt="profile" />

                </div>
                <div class="col ms-5">
                    <h3>Admin Information</h3>
                    <ul class="list-ticked mt-4">
                        <li><strong> Name - </strong> {{ $adminProfile->name }}</li>
                        @if($adminProfile->nickname != null)
                            <li><strong> Nickname - </strong> {{ $adminProfile->nickname }}</li>
                        @endif
                        <li><strong> E-Mail - </strong> {{ $adminProfile->email }}</li>
                        <li><strong> Phone - </strong> {{ $adminProfile->phone }}</li>
                        <li><strong> Address - </strong> {{ $adminProfile->address }}</li>
                        <li><strong> Provider - </strong> {{ $adminProfile->provider }}</li>
                    </ul>
                    <hr>
                    <div class="text-center mt-4">
                        <a href="{{route('admin.list')}}">
                            <button class="btn btn-primary text-light">Back</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
