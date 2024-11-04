@extends('admin.layouts.app')
@section('navbar')
    @include('admin.inc.navbar')
@endsection
@section('main')
    <div class="container-fluid ">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Xem trước bài viết</div>
                    <div class="card-body">

                        <p>{{ $blog->title }}</p>
                        @php
                            echo $blog->description;
                        @endphp
                        <br>
                        Trạng thái:
                        @if($blog->status == 1)
                            <p class="text-success">Hiển thị</p>
                        @elseif($blog->status == 0)
                            <p class="text-danger">Không hiện thị</p>
                        @elseif($blog->status == 3)
                            <p class="text-danger">Bị từ chối</p>
                        @else
                            <p class="text-warning">Đang đợi duyệt</p>
                        @endif
                        <br>
                        Ngày đăng: {{ $blog->created_at }}

                        <img width="200px" height="100px" src="{{ asset('uploads/blogs/'.$blog->image) }}" alt=""><br>

                        @hasanyrole('houseRenter|viewer')
                        <a class="btn btn-warning" href="{{ route('admin.blogs.myblogs') }}">Quay lại</a>
                        @endrole

                        @role('admin')
                        <a class="btn btn-warning" href="{{ route('admin.get_pending_blogs') }}">Quay lại</a>

                        <form action="{{ route('admin.blogs.accept_blog', $blog->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <input name="status" type="hidden" value="1">
                            </div>
                            <button type="submit" class="btn btn-primary">Xác nhận duyệt bài</button>
                        </form>

                        <!-- Nút Từ chối mở popup -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectPostModal">
                            Từ chối
                        </button>

                        <!-- Modal từ chối -->
                        <div class="modal fade" id="rejectPostModal" tabindex="-1" aria-labelledby="rejectPostModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="rejectPostModalLabel">Lý do từ chối bài viết</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="rejectForm" action="{{ route('admin.blogs.decline_blog', $blog->id) }}" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <div class="form-group">
                                                <label for="reason">Lý do từ chối:</label>
                                                <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
                                                <input name="status" type="hidden" value="3">
                                            </div>
                                            <button type="submit" class="btn btn-danger">Gửi</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endrole
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
