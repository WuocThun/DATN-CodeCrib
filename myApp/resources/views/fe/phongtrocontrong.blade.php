@extends('fe.layouts.app')
@section('header')
    @include('fe.inc.header')
@endsection

@section('main')
    <style>
        .call-btn {
            background-color: #007bff;
            border: none;
            font-size: 14px;
            color: white;
        }
    </style>
    <section class="search-results">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif    @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

        </div>
        <div class="container search-results-container">

            <div class="results-left">
                <h2>Tổng {{count($motels)}} kết quả phòng trọ còn trống</h2>
                @if($motels->isEmpty())
                    <p>Không tìm thấy phòng trọ với mật khẩu đã nhập.</p>
                @else
                    @foreach($motels as $room => $motel)

                        {{--                    <a href="{{route('getRoom',$motel->slug)}}" style="text-decoration: none;">--}}
                        <div class="result-item">
                            @php

                                $images = json_decode($motel->image, true);
                            @endphp
                            <img src="{{asset('uploads/logoCodeCrib.png')}}" alt="Ký túc xá Tân Bình">
                            <div class="result-info">
                                <h3>{{$motel->name}}</h3>
                                <p>{{$motel->full_address}} </p>
                                <p>{{number_format($motel->money,0,',', '.')}} nghìn/tháng - {{$motel->area}}m² </p>

                                {{--                            <p>{{ \Illuminate\Support\Str::limit($motel->description, 15, '...') }}</p>--}}
                                <div class="contact-options">
                                    <button class="btn  call-btn ">Gọi {{$motel->phone_number}}</button>
                                    @role('viewer||admin')
                                    <form action="{{ route('room-requests.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="motel_id" value="{{ $motel->id }}">
                                        <button type="submit" class="btn btn-warning">Yêu cầu tham gia</button>
                                    </form>
                                    @endrole
                                </div>
                            </div>
                        </div>
                        {{--                    </a>--}}
                    @endforeach
                @endif

                <div class="pagination">
                    @if ($motels->onFirstPage())
                        <button class="prev" disabled>« Trang trước</button>
                    @else
                        <a href="{{ $motels->previousPageUrl() }}" class="prev">« Trang trước</a>
                    @endif

                    @for ($page = 1; $page <= $motels->lastPage(); $page++)
                        <a href="{{ $motels->url($page) }}"
                           class="page {{ $page == $motels->currentPage() ? 'active' : '' }}">{{ $page }}</a>
                    @endfor

                    @if ($motels->hasMorePages())
                        <a href="{{ $motels->nextPageUrl() }}" class="next">Trang sau »</a>
                    @else
                        <button class="next" disabled>Trang sau »</button>
                    @endif
                </div>

            </div>

            @include('fe.inc.fitler_blogs_right')
        </div>

    </section>
    <script>

        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.add-to-wishlist').forEach(function (button) {
                button.addEventListener('click', function (e) {
                    e.preventDefault(); // Ngăn chặn hành vi mặc định của trình duyệt

                    let roomId = this.dataset.roomId;

                    fetch('{{ route("wishlist.add") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({ room_id: roomId }),
                    })
                        .then(response => {
                            const contentType = response.headers.get('content-type');
                            if (!contentType || !contentType.includes('application/json')) {
                                throw new Error('Server did not return JSON');
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.status === 'success') {
                                showPopup(data.message, 'success');
                            } else {
                                showPopup(data.message, 'error');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            showPopup('Đã xảy ra lỗi. Vui lòng thử lại sau.', 'error');
                        });
                });
            });

            function showPopup(message, type) {
                const popup = document.createElement('div');
                popup.className = `popup-message ${type}`;
                popup.innerText = message;

                document.body.appendChild(popup);

                setTimeout(() => {
                    popup.remove();
                }, 3000);
            }
        });


    </script>

    <style>
        .popup-message {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 15px 20px;
            color: #fff;
            border-radius: 5px;
            z-index: 9999;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.5s ease-out;
        }

        .popup-message.success {
            background-color: #4caf50;
        }

        .popup-message.error {
            background-color: #f44336;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endsection
@section('overView')
    @include('fe.inc.over_view')
@endsection
@section('footer')
    @include('fe.inc.footer')
@endsection

