@extends('Admin.layout.master')

@section('admin-ui')
    {{-- order list headline  --}}
    <div class="row">
        <div class="col-5">
            <h2 class="text-muted">ORDER LIST</h2>
        </div>
        <div class="col d-flex justify-content-evenly">
            <div class="btn-group">
            </div>
            <form action="" method="get" style="width: 60%">
                @csrf
                <input type="text" class="form-control" placeholder="Enter Order Code / User Name" name="searchKey" value="{{request('searchKey')}}">
            </form>
        </div>
    </div>
    {{-- order list headline end --}}

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
                            @foreach ($order as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td class="text-primary fw-bold"><a href="{{ route('order.detail',$item->order_code) }}"
                                            class="text-decoration-none orderCode">{{ $item->order_code }}</a></td>
                                    <td>
                                        <select name="status" id="" class="form-select w-50 text-center m-auto status">
                                            <option value="0" @if ($item->status == 0) selected @endif>Pending
                                            </option>
                                            @if ($item->product->stock >= $item->count)
                                                 <option value="1" @if ($item->status == 1) selected @endif>Success
                                            </option>
                                            @endif
                                            <option value="2" @if ($item->status == 2) selected @endif>Reject
                                            </option>
                                        </select>
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

@section('script')

<script>
    $(document).ready(function(){
        $('.status').change(function(){
           status = $(this).val();
           orderCode = $(this).parents('tr').find('.orderCode').text();
           data = {
            'status' : status,
            'order_code' : orderCode
           }

            $.ajax({
                type: 'GET',
                url : '/admin/status',
                data : data,
                dataType : 'json',
                success : function(res){
                    res.status == 'success' ? location.reload() : " ";
                }
            })
        })

    })
</script>

@endsection

