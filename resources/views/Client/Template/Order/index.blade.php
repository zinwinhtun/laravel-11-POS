@extends('Client.Layout.main')

@section('main-ui')
    <div class="container-fluid py-5 mt-5">
        <div class="container py-5 mt-3">
            <table class="table table-hover text-center">
                <thead>
                    <th>#</th>
                    <th>Order Code</th>
                    <th>Status</th>
                    <th>Date</th>
                </thead>
                <tbody>
                    @foreach ($order as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-bold text-primary"><a href="#">{{ $item->order_code }}</a></td>
                            <td>
                                {{-- 0 =>pending , 1 => success , 2 => reject  --}}
                                @if ($item->status == 0)
                                    <span class="bg-warning px-3 py-1 rounded fw-bold text-light">pending</span>
                                @elseif ($item->status == 1)
                                    <span class="bg-primary px-3 py-1 rounded fw-bold text-light">Success</span>
                                @else
                                    <span class="bg-danger px-3 py-1 rounded fw-bold text-light">Reject</span>
                                @endif
                            </td>
                            <td>{{ $item->created_at->format('d-m-Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
