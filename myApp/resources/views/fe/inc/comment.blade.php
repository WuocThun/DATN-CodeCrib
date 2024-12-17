<style>
    .star-rating .bi-star-fill {
        font-size: 2rem; /* Kích thước ngôi sao lớn hơn */

        color: #ffc107;
        cursor: pointer;
    }
    .star-rating .bi-star-fill.inactive {
        color: #ddd;
    }
    .btn-danger {
        color: #af8503;
    }
    .pagination button {
        color: grey;
    }
</style>
<div class="container mt-5">
    <h1 class="mb-4">Gửi Bình Luận</h1>

    <!-- Hiển thị lỗi validate -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form bình luận -->
    <form action="{{ route('comments.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="content" class="form-label">Nội dung bình luận</label>
            <textarea name="content1" id="content" class="form-control" rows="5" required></textarea>
        </div>
        <input type="hidden" name="room_id" value="{{ $roomId ?? '' }}">
        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
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

        <button type="submit" class="btn btn-primary">Gửi</button>
    </form>
</div>
<!-- Bootstrap JS -->
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
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

