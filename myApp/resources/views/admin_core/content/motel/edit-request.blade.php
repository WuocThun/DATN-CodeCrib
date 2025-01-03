@extends('admin_core.layouts.test')

@section('main')
    <div class="container">
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

        <h2>Chỉnh sửa phòng tin ở ghép</h2>

        <form action="{{ route('admin.updateUserRequest', $request->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Tiêu đề</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $request->title }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Mô tả</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ $request->description }}</textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Ảnh</label>
                @if($request->image)
                    <div id="carouselExample" class="carousel slide">
                        <div class="carousel-inner">
                            @foreach (json_decode($request->image, true) as $index => $image)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <img class="d-block w-100" src="{{ asset($image) }}" alt="Image {{ $index + 1 }}" style="height: 300px; object-fit: cover;">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                <input type="file" class="form-control" id="contract_image" name="image[]" multiple>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Trạng thái</label>
                <select class="form-select" id="status" name="status">
                    <option value="0" {{ $request->status == 0 ? 'selected' : '' }}>Chưa xử lý</option>
                    <option value="1" {{ $request->status == 1 ? 'selected' : '' }}>Đã chấp nhận</option>
                    <option value="2" {{ $request->status == 2 ? 'selected' : '' }}>Đã từ chối</option>
                </select>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </div>
        </form>
    </div>
@endsection
