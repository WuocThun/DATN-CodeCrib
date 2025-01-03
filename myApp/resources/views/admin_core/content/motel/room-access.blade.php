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
        @if(isset($motel))
            <div class="row">

                <div class="col-md-4 mb-3">
                    <div class="card room-card">
                        <!-- Header -->
                        <div class="card-header text-center bg-warning">
                            <img class="img-fluid" src="{{ asset('uploads/logoCodeCrib.png') }}">
                        </div>
                        <!-- Body -->
                        <div class="card-body">
                            <h6 class="room-name">{{ $motel->name }}</h6>
                            <ol class="list-group list-group-numbered">
                                <li class="list-group-item d-flex justify-content-between align-items-start center">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Nhập mật khẩu để mở khoá</div>
                                        <button type="button" class="fs-m btn-info" data-bs-toggle="modal"
                                                data-bs-target="#requestModal{{$motel->id}}">
                                            Tại đây
                                        </button>
                                    </div>
                                </li>
                            </ol>
                            <div class="modal fade" id="requestModal{{$motel->id}}" tabindex="-1"
                                 aria-labelledby="requestModalLabel{{$motel->id}}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="requestModalLabel{{$motel->id}}">Danh sách yêu
                                                cầu tham gia phòng</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('admin.check.passcode') }}" method="POST">
                                                @csrf

                                                <div class="mb-3">
                                                    <label for="motel_id" class="form-label text-dark">Tên
                                                        phòng: {{$motel->name }}</label>

                                                    <input type="text" name="motel_id" hidden value="{{ $motel->id }}"
                                                           id="">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="password" class="form-label text-dark">Nhập
                                                        password</label>
                                                    <input type="text" class="form-control" id="password"
                                                           name="password" required>
                                                </div>

                                                <button type="submit" class="btn btn-primary">Kiểm Tra</button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Đóng
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="viewContract{{ $motel->id }}" tabindex="-1"
                                 aria-labelledby="viewContractLabel{{ $motel->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="viewContractLabel{{ $motel->id }}">Xem hợp đồng {{ $motel->name }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            @if ($motel->contracts->isNotEmpty())
                                                @foreach ($motel->contracts as $contract)
                                                    <p><strong>Tên người thuê:</strong> {{ $contract->tenant_name }}</p>
                                                    <p><strong>Tên chủ trọ:</strong> {{ $contract->owner_name }}</p>
                                                    <p><strong>Ngày bắt đầu:</strong> {{ $contract->start_date }}</p>
                                                    <p><strong>Ngày kết thúc:</strong> {{ $contract->end_date }}</p>

                                                    @if ($contract->contract_image)
                                                        <p><strong>Ảnh chứng minh:</strong></p>
                                                        @foreach (json_decode($contract->contract_image, true) as $image)
                                                            <img src="{{ asset('uploads/contracts/' . $image) }}" alt="Hợp đồng" style="width: 100%; max-width: 300px; margin-bottom: 10px;">
                                                        @endforeach
                                                    @endif

                                                    @if ($contract->contract_file)
                                                        <p><strong>Hợp đồng file:</strong>
                                                            <a href="{{ asset($contract->contract_file) }}" target="_blank">Xem file hợp đồng</a>
                                                        </p>
                                                    @endif

                                                    <hr>
                                                @endforeach
                                            @else
                                                <p>Hợp đồng chưa được chủ phòng tạo</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="shareHome{{ $motel->id }}" tabindex="-1"
                                 aria-labelledby="shareHomeLabel{{ $motel->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="shareHomeLabel{{ $motel->id }}">Đăng tin kiếm người ở ghép: <strong> {{ $motel->name }} </strong></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('admin.requests.create')}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="motel_id" class="form-label">Phòng Trọ</label>
                                                        <select class="form-select" name="motel_id" required>
    {{--                                                        @foreach ($userMotels as $motel)--}}
                                                                <option value="{{ $motel->id }}">{{ $motel->name }}</option>
    {{--                                                        @endforeach--}}
                                                        </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="title" class="form-label">Tiêu Đề</label>
                                                    <input type="text" class="form-control" name="title" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="description" class="form-label">Mô Tả</label>
                                                    <textarea class="form-control" name="description" rows="4"></textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="contract_image" class="form-label">Tải ảnh phòng hiện tại</label>
                                                    <input type="file" class="form-control" id="contract_image"
                                                           name="image[]" multiple>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Đăng Bài</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="invitedUser{{ $motel->id }}" tabindex="-1"
                                 aria-labelledby="invitedUserLabel{{ $motel->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="invitedUserLabel{{ $motel->id }}">Mời người dùng vào phòng: <strong> {{ $motel->name }} </strong></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Form tìm kiếm người dùng -->
                                            <form id="searchUserForm{{ $motel->id }}">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="rand_code_user" class="form-label">Nhập mã người dùng</label>
                                                    <input type="text" class="form-control" id="rand_code_user{{ $motel->id }}" name="rand_code_user" required>
                                                </div>
                                                <button type="button" class="btn btn-primary" onclick="searchUser({{ $motel->id }})">Tìm kiếm</button>
                                            </form>

                                            <!-- Hiển thị kết quả tìm kiếm -->
                                            <div id="userInfo{{ $motel->id }}" style="display: none;">
                                                <hr>
                                                <h5>Thông tin người dùng</h5>
                                                <p id="userName{{ $motel->id }}"></p>
                                                <p id="userEmail{{ $motel->id }}"></p>
                                                <p id="userPhone{{ $motel->id }}"></p>

                                                <!-- Gửi lời mời -->
                                                <form action="{{ route('invite-user') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="motel_id" value="{{ $motel->id }}">
                                                    <input type="hidden" id="user_id{{ $motel->id }}" name="user_id">
                                                    <button type="submit" class="btn btn-success">Mời tham gia</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="room-info my-3">
                                @if (session("motel_unlocked_{$motel->id}"))
                                    <div class="actions d-flex justify-content-between">
                                        <button class="btn btn-info"
                                                onclick="window.location.href='{{ route('admin.motel.addUserMotel', ['id' => $motel->id]) }}'">
                                            <i class="fas fa-user-friends"></i>
                                        </button>
                                        @if(isset($motel->getInvoicesBy($motel->id)->first()->id))
                                            <button class="btn btn-warning"
                                                    onclick="window.location.href='{{ route('admin.invoices.pay', ['id' => $motel->getInvoicesBy($motel->id)->first()->id]) }}'">
                                                <i class="fas fa-receipt"></i>
                                            </button>
                                        @endif
                                        <button class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#viewContract{{$motel->id}}">
                                            <i  class='fas fa-file-contract'></i>
                                        </button>
                                        <button class="btn btn-secondary" data-bs-toggle="modal"
                                                data-bs-target="#shareHome{{$motel->id}}">
                                            <i class="fas fa-share"></i>
                                        </button>
                                        <button class="btn btn-warning position-relative" data-bs-toggle="modal"
                                                data-bs-target="#editUserRequest{{$motel->id}}">
                                            <i class="fas fa-plus"></i>
                                        </button>

                                        <form action="{{ route('admin.motel.leave') }}"
                                              method="POST" style="display: inline;">
                                            @csrf
{{--                                            @method('DELETE')--}}
                                            <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Bạn có muốn thoát phòng không?')">
                                                <i class="fas fa-sign-out-alt"></i></button>
                                        </form>
                                    </div>
                                @else
                                    <p class="text-danger">Bạn cần nhập đúng mật khẩu để mở khóa phòng.</p>
                                @endif
                            </div>

                            <div class="card-footer text-center row">
                                <div class="col-md-6  ">
                                    <p>Ngày tính
                                        tiền: {{ \Carbon\Carbon::parse($motel->money_date)->format('d/m/Y') }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p>Tiền phòng: {{ number_format($motel->money,0,',', '.') }} đ</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Card -->
                </div>

            </div>
        @else
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="card room-card">
                        <!-- Header -->
                        <div class="card-header text-center bg-warning">
                            <img class="img-fluid" src="{{ asset('uploads/logoCodeCrib.png') }}">
                        </div>
                        <!-- Body -->
                        <div class="card-body">
                            <h6 class="room-name">Bạn chưa có phòng nào hết, mau đăng ký lẹ đi</h6>

                            <div class="card-footer text-center row">
                            </div>
                        </div>
                    </div>
                    <!-- End Card -->
                </div>

            </div>

        @endif
    </main>
    <script>
        function searchUser(motelId) {
            const randCode = document.getElementById(`rand_code_user${motelId}`).value;

            fetch('{{ route("search-user") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ rand_code_user: randCode }),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                    } else {
                        document.getElementById(`userInfo${motelId}`).style.display = 'block';
                        document.getElementById(`userName${motelId}`).innerText = `Tên: ${data.user.name}`;
                        document.getElementById(`userEmail${motelId}`).innerText = `Email: ${data.user.email}`;
                        document.getElementById(`userPhone${motelId}`).innerText = `Số điện thoại: ${data.user.phone_number}`;
                        document.getElementById(`user_id${motelId}`).value = data.user.id;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

    </script>
@endsection




