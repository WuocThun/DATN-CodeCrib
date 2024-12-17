@extends('admin_core.layouts.test')

@section('main')

    <main role="main" class="ml-sm-auto col">
        @include('admin_core.inc.sub_main')
        {{--        <button data-user-id="{{ auth()->id() }}" class="add-more-motel btn zalo-btn">Thêm vào danh sách yêu thích</button>--}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h2>Hoá đơn</h2>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Phòng</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Tổng tiền</th>
                        <th scope="col">Ngày tạo hoá đơn</th>
                        <th scope="col">Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($invoices as $inv => $data)
                        <tr>
                            <th scope="row">{{$data->motel->name }}</th>
                            @if($data->status == 'paid')
                                <td><span class="badge badge-warning">Da thanh toan</span></td>
                            @else
                                <td><span class="badge badge-primary">chua thanh toan</span></td>
                            @endif
                            <td>{{ number_format($data->total_amount,0,',', '.') }} VNĐ</td>
                            <td>{{ \Carbon\Carbon::parse($data->created_at)->format('d/m/Y') }}</td>
                            <td>
                                <div class="row">
                                        <button class="btn btn-success ml-3" onclick="window.location.href='{{ route('admin.invoices.pay',['id'=>$data->id])}}'">
                                            <i class="fas fa-money-check"></i>
                                        </button>
{{--                                    <button class="btn btn-info" onclick="window.location.href='{{ route('admin.motel.addUserMotel', ['id' => $motel->id]) }}'">--}}
                                    <button  class="btn btn-info ml-3" >
                                            <i class="far fa-eye"></i>
                                        </button>
                                        <button class="btn btn-warning ml-3" onclick="window.location.href='{{ route('admin.motel.addUserMotel',['id'=>$data->motel->id])}}'">
                                            <i class="fas fa-users"></i>
                                        </button>
                                    <button class="btn btn-danger ml-3">
                                        <i class="fas fa-minus-circle"></i>                                        </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>

@endsection

