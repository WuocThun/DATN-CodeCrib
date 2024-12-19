<div class="results-right">
    <div class="modal fade" id="addMemberModal" tabindex="-1" aria-labelledby="addMemberModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMemberModalLabel">Góp ý website</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container mt-5">
                        <h1 class="text-center">Góp ý website</h1>
                        @error('g-recaptcha-response')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('reviews.store') }}" method="POST" class="mt-4">
                            @csrf
                            <!-- Đánh giá sao -->
                            <div class="mb-3">
                                <label for="rating" class="form-label">Đánh giá (1-5 sao)</label>
                                <select name="rating" id="rating" class="form-control">
                                    <option value="">Chọn số sao</option>
                                    <option value="1">1 - Kém</option>
                                    <option value="2">2 - Trung bình</option>
                                    <option value="3">3 - Khá tốt</option>
                                    <option value="4">4 - Tốt</option>
                                    <option value="5">5 - Xuất sắc</option>
                                </select>
                            </div>

                            @if(Auth::check())
                                <div class="mb-3">
                                    <p><strong>Tên:</strong> {{ Auth::user()->name }}</p>
                                    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                                </div>
                            @else
                                <div class="mb-3">
                                    <label for="name" class="form-label">Tên</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                            @endif
                            <div class="mb-3">
                                <label for="comment" class="form-label">Nhận xét</label>
                                <textarea class="form-control" id="comment" name="comment" rows="4" required></textarea>
                            </div>

                            <br/>
                            <!-- Nút Gửi -->
                            @role('admin')
                            <input type="hidden" name="status" value="1">
                            @endrole
                            @role('houseRenter||viewer')
                            <input type="hidden" name="status" value="0">
                            @endrole
                            <div class="d-grid">
                                <button type="submit" class="btn btn-danger">Gửi Đánh Giá</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="filter-section">
        <h3>Nhập mật khẩu phòng trọ</h3>
        <form method="GET" action="{{ route('room-requests.index') }}">
            <div class="input-group mb-3">
                <input type="text" name="password" class="form-control" placeholder="Mật khẩu phòng trọ" aria-label="Nhập mật khẩu phòng trọ để lọc nhanh hơn" aria-describedby="basic-addon2" value="{{ request('password') }}">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Tìm kiếm</button>
                </div>
            </div>
            <h3>Tìm kiếm phòng trọ</h3>
            <div class="input-group mb-3">
                <input type="text" name="keyword" class="form-control" placeholder="Nhập từ khóa liên quan" aria-label="Nhập từ khóa tìm kiếm" aria-describedby="basic-addon2" value="{{ request('keyword') }}">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Tìm kiếm</button>
                </div>
            </div>
        </form>
    </div>
    <div class="filter-section">
        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addMemberModal">Góp ý website
        </button>
    </div>
    <div class="filter-section">
        <h3>Danh mục cho tin cho thuê</h3>
        <ul>
            <li> <a class="filer_blogs" href="{{ url('/bo-loc/phong?min_price=0&max_price=1000000') }}">Dưới 1 triệu</a></li>
            <li>  <a class="filer_blogs" href="{{ url('/bo-loc/phong?min_price=1000000&max_price=2000000') }}"> 1 triệu - 2 triệu</a></li>
            <li> <a class="filer_blogs" href="{{ url('/bo-loc/phong?min_price=2000000&max_price=3000000') }}">2 triệu - 3 triệu</a></li>
            <li> <a class="filer_blogs" href="{{ url('/bo-loc/phong?min_price=3000000&max_price=5000000') }}">3 triệu - 5 triệu</a></li>
            <li> <a class="filer_blogs" href="{{ url('/bo-loc/phong?min_price=5000000') }}">Trên 5 triệu</a></li>
        </ul>
    </div>

    <div class="newstr">
        <h3>Phòng ngẫu nhiên</h3>
        <ul>
                @foreach($randomRooms as $room)
            <li>
                <a href="{{route('getRoom',$room->slug)}}">
                    <img src=" {{asset('uploads/fe/img/room1.jpg')}} " alt="Phòng trọ mới" />
                    <div>
                        <span class="post-meta">{{ \Illuminate\Support\Str::limit($room->title, 15, '...') }}</span>
                        <span class="post-price">{{number_format($room->price,0,',', '.')}} nghìn/tháng</span>
{{--                        <span class="post-time">{{$room->}}</span>--}}
                    </div>
                </a>
            </li>
            @endforeach

        </ul>
    </div>
    <div class="newstr">
        <h3>Tin ngẫu nhiên</h3>
        <ul>
                @foreach($randomBlogs as $blogs)
            <li>
                <a href="{{route('getBlog',$blogs->slug)}}">
                    <img src=" {{asset('uploads/fe/img/room1.jpg')}} " alt="Phòng trọ mới" />
                    <div>
                        <span class="post-meta">{{ \Illuminate\Support\Str::limit($blogs->title, 15, '...') }}</span>
{{--                        <span class="post-price">{{number_format($room->price,0,',', '.')}} nghìn/tháng</span>--}}
{{--                        <span class="post-time">{{$room->}}</span>--}}
                    </div>
                </a>
            </li>
            @endforeach

        </ul>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // JavaScript để xử lý đánh giá sao
    document.addEventListener('DOMContentLoaded', function () {
        const stars = document.querySelectorAll('.star-rating .bi-star-fill');
        const ratingInput = document.getElementById('rating');

        stars.forEach(star => {
            star.addEventListener('click', function () {
                const value = this.getAttribute('data-value');
                ratingInput.value = value;

                stars.forEach(s => {
                    if (s.getAttribute('data-value') <= value) {
                        s.classList.remove('inactive');
                    } else {
                        s.classList.add('inactive');
                    }
                });
            });
        });
    });
</script>
