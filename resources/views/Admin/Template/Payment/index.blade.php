@extends('Admin.layout.master')

@section('admin-ui')
    {{-- {{dd($methods)}} --}}
    <div class="row">
        <div class="col-3">
            <!--Payment Button trigger modal -->

            <button type="button" class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#createModal"> ADD
                PAYMENT</button>

            <!-- Modal -->
            <div class="modal fade  @if ($errors->any()) show @endif " id="createModal" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true"
                @if ($errors->any()) style="display: block;" @endif>
                <div class="modal-dialog ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5 text-muted" id="exampleModalLabel">Create Payment Account</h1>
                        </div>
                        <div class="modal-body">
                            <div class="card">
                                <div class="card-body">
                                    {{-- create form  --}}
                                    <form class="forms-sample" action="{{ route('payment.store') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Account Name</label>
                                            <input type="text" name="account_name" class="form-control"
                                                id="exampleInputUsername1" placeholder="Enter Account Name">
                                            @error('account_name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Account Number</label>
                                            <input type="number" name="account_number" class="form-control"
                                                id="exampleInputEmail1" placeholder="Enter Account Number">
                                            @error('account_number')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <select name="payment_methods" class="form-select" name=""
                                                id="">
                                                <option value="#" readonly>Select Account Methods</option>
                                                @foreach ($methods as $method)
                                                    <option value="{{ $method }}">{{ $method }}</option>
                                                @endforeach
                                            </select>
                                            <div class="">
                                                @error('payment_methods')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary me-2 text-light">Submit</button>
                                        <a href="{{ route('payment.index') }}"><button type="button"
                                                class="btn btn-danger text-light">Cancel</button></a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-7 offset-1  d-flex justify-content-end ">
            <form action="" method="get">
                <input type="text" name="searchData" value="{{ request('searchData') }}" class="form-control"
                    placeholder="Search Here">
            </form>

            <button class="btn btn-sm btn-primary text-light ms-3 me-3 dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">Methods</button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('payment.index') }}">ALL Methods</a>
                @foreach ($methods as $method => $method_value)
                    <a class="dropdown-item" href="{{ route('payment.index', ['methods' => $method]) }}">{{$method_value}}</a>
                @endforeach
            </div>

        </div>
    </div>
    <div class="row mt-5">
        <div class="col ">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Recent Payment Account List</p>
                    <div class="table-responsive">
                        <table id="recent-purchases-listing" class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Account Name</th>
                                    <th>Account Number</th>
                                    <th>Account Type</th>
                                    <th>Tools</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $payment)
                                    <tr>
                                        <td class="">{{ $loop->iteration }}</td>
                                        <td class="">{{ $payment->account_name }}</td>
                                        <td class="">{{ $payment->account_number }}</td>
                                        <td class="">{{ $payment->payment_methods }}</td>
                                        <td>
                                            <div class="row ">
                                                <div class="col-8 offset-2 d-flex justify-content-spacebetween ">
                                                    <!-- Edit Button trigger modal -->
                                                    <div class="">
                                                        <button type="button" class="btn btn-primary text-light"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#updateModal-{{ $payment->id }}">
                                                            <i class="mdi mdi-pencil"></i>
                                                        </button>

                                                        <!-- Modal -->
                                                        <div class="modal fade @if ($errors->any()) show @endif "
                                                            id="updateModal-{{ $payment->id }}" data-bs-backdrop="static"
                                                            data-bs-keyboard="false" tabindex="-1"
                                                            aria-labelledby="staticBackdropLabel" aria-hidden="true"
                                                            @if ($errors->any()) style="display: block;" @endif>
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5"
                                                                            id="staticBackdropLabel">
                                                                            Edit Payment Account </h1>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    {{-- create form  --}}
                                                                    <form class="forms-sample p-3"
                                                                        action="{{ route('payment.update', $payment->id) }}"
                                                                        method="POST">
                                                                        @csrf @method('PUT')
                                                                        <div class="form-group">
                                                                            <label for="exampleInputUsername1">Account
                                                                                Name</label>
                                                                            <input type="text" name="account_name"
                                                                                class="form-control"
                                                                                id="exampleInputUsername1"
                                                                                placeholder="Enter Account Name"
                                                                                value="{{ old('account_name', $payment->account_name) }}">
                                                                            @error('account_name')
                                                                                <small
                                                                                    class="text-danger">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="exampleInputEmail1">Account
                                                                                Number</label>
                                                                            <input type="number" name="account_number"
                                                                                class="form-control"
                                                                                id="exampleInputEmail1"
                                                                                placeholder="Enter Account Number"
                                                                                value="{{ old('account_number', $payment->account_number) }}">
                                                                            @error('account_number')
                                                                                <small
                                                                                    class="text-danger">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <select name="payment_methods"
                                                                                class="form-select" name=""
                                                                                id="">
                                                                                <option value="#" readonly>Select
                                                                                    Account Methods</option>
                                                                                @foreach ($methods as $method => $method)
                                                                                    <option
                                                                                        @if (old('payment_methods', $payment->payment_methods == $method)) selected @endif>
                                                                                        {{ $method }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            <div class="">
                                                                                @error('payment_methods')
                                                                                    <small
                                                                                        class="text-danger">{{ $message }}</small>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <button type="submit"
                                                                            class="btn btn-primary me-2 text-light">Submit</button>
                                                                        <a href="{{ route('payment.index') }}">
                                                                            <button type="button"
                                                                                class="btn btn-danger text-light">Cancel</button>
                                                                        </a>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- delete button  --}}
                                                    <div class="ms-2">
                                                        <form action="{{ route('payment.destroy', $payment->id) }}"
                                                            method="post">
                                                            @csrf @method('delete')
                                                            <button class="btn btn-danger text-light fw-bold"><i
                                                                    class="mdi mdi-delete-forever"></i></button>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
