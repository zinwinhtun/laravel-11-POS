@extends('Admin.layout.master')

@section('admin-ui')

     {{-- order list table  --}}
    <div class="container">
        <div class="row">
            <div class="card mt-5">
                <div class="my-3 ms-5">
                   <small class="text-danger"><strong class="me-2"><i class="mdi mdi-alert h4"></i> Note</strong>Click Order Code To See Order Detail..</small>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>Order Code</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        {{-- order tabel list  --}}
                        <tbody>
                            @foreach ($confirmOrder as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td class="text-primary fw-bold"><a href="{{ route('order.detail',$item->order_code) }}"
                                            class="text-decoration-none orderCode">{{ $item->order_code }}</a></td>
                                    <td>
                                    @if ($item->status == 1)
                                       <span class="bg-success text-light p-2 rounded">SUCCESS</span>
                                    @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- order list table  end --}}
@endsection
