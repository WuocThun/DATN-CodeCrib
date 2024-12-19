@extends('admin_core.layouts.test')

@section('main')

    <main role="main" class="ml-sm-auto col">
        @include('admin_core.inc.sub_main')
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('welcome')}}">Code Crib</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.dashboardCore')}}">Quản lý</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Thêm phòng quản lý</li>
            </ol>
        </nav>
        <form action="{{ route('admin.motel.update', ['id' => $motel->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3>Sửa phòng trọ: {{$motel->name}}</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="text-dark" for="">Tên phòng</label> <label>*</label>
                                <input class="nameform form-control" value="{{$motel->name }}"
                                       name="name" type="text"/>
                                <input type="number" hidden value="{{$invoice->old_water ?? $motel->default_water}}" name="old_water">
                                <input type="number" hidden value="{{$invoice->old_electric ?? $motel->default_electric}}" name="old_electric">
                                <input type="number" hidden value="{{$invoice->new_electric ?? null}}" name="new_electric">
                                <input type="number" hidden value="{{$invoice->new_water ?? null}}" name="new_water">
                            </div>
                            <div class="form-group">
                                <label class="text-dark">Tiền phòng (Tr/Tháng)</label> <label>*</label>
                                <input class="nameform form-control $invoice" id="money" value="{{$motel->money}}"
                                       name="money" type="text"/>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-dark" for="">Số điện hiện tại (kW)</label> <label>*</label>
                                        <input class="nameform form-control" value="{{$motel->default_electric}}"
                                               name="default_electric" type="number" min="1" max="{{$invoice->new_electric ?? null}}" step="1"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-dark" for="">Số nước hiện tại (m/<sup>3</sup>)</label>
                                        <label>*</label>
                                        <input class="nameform form-control" value="{{$motel->default_water}}"
                                               name="default_water" type="number" min="1" max="{{$invoice->new_water ?? null}}" step="1"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-dark" for="">Số tiền điện trên 1kW</label> <label>*</label>
                                        <input class="nameform form-control $invoice"
                                               value="{{$motel->money_electric}}" name="money_electric" type="text"
                                               min="1" step="1"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-dark" for="">Số tiền nước trên 1m/<sup>3</sup></label>
                                        <label>*</label>
                                        <input class="nameform form-control $invoice"
                                               value="{{$motel->money_water}}" name="money_water" type="text" min="1"
                                               step="1"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-dark" for="">Tiền Wifi</label>
                                        <input class="nameform form-control $invoice"
                                               value="{{$motel->money_wifi}}" name="money_wifi" type="text" min="0"
                                               step="1"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-dark" for="">Tiền rác + phụ thu</label>
                                        <input class="nameform form-control $invoice"
                                               value="{{$motel->money_another}}" name="money_another" type="text"
                                               min="0" step="1"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="">Ngày tính tiền hàng tháng</label>
                                        <input id="money_date"
                                               value="{{ old('money_date', $motel->money_date) }}"
                                               class="nameform form-control" name="money_date" type="date" min="1"
                                               step="1"/>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="">Loại phòng</label>
                                        <select name="kind_motel" class="form-control">
                                            <option value="0" {{ $motel->kind_motel === 0 ? 'selected' : '' }}>Chọn loại
                                                phòng:
                                            </option>
                                            <option value="1" {{ $motel->kind_motel === 1 ? 'selected' : '' }}>DEMO
                                            </option>
                                            <option value="2" {{ $motel->kind_motel === 1 ? 'selected' : '' }}>ABC
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="">Trạng thái phòng</label>
                                        <select name="status" class="form-control">
                                            <option value="1" {{ $motel->status === 1 ? 'selected' : '' }} >Phòng tìm kiếm người cho thuê
                                            </option>
                                            <option value="0" {{ $motel->status === 0 ? 'selected' : '' }}>Phòng để quản lý
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Cập nhật</button>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>
    <script>
        // Lấy phần tử input theo id
        document.addEventListener('DOMContentLoaded', function () {
            // Lấy phần tử input theo id
            const dateInput = document.getElementById('money_date');

            // Lấy ngày hiện tại
            const today = new Date();
            const formattedDate = today.toISOString().split('T')[0]; // Định dạng yyyy-mm-dd

            // Đặt giá trị mặc định là ngày hiện tại và thiết lập giá trị tối thiểu
            dateInput.value = formattedDate;
            dateInput.setAttribute('min', formattedDate);

            // Lắng nghe sự kiện thay đổi giá trị
            dateInput.addEventListener('change', function () {
                // Nếu ngày được chọn nhỏ hơn ngày hiện tại, tự động đặt lại thành ngày hiện tại
                if (new Date(this.value) < today) {
                    alert('Bạn không thể chọn ngày cũ. Ngày đã được tự động chỉnh sửa!');
                    this.value = formattedDate;
                }
            });
        });
    </script>


@endsection

