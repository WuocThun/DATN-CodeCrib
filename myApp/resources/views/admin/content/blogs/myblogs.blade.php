@extends('admin.layouts.app')
@section('navbar')
    @include('admin.inc.navbar')
@endsection
@section('main')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Danh Sách Blog</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <a href="{{route('admin.blogs.create')}}" class="btn btn-success"> Thêm Blog </a>
                        <table class="table">
                            <thead>
                            <tr>
                                <table id="myTable" class="table">
                                    <thead>
                                    <th scope="col">ID</th>
                                    <th scope="col">Tên danh mục</th>
                                    <th scope="col">Mô tả</th>
                                    <th scope="col">Hiển thị</th>
                                    <th scope="col">Loại tin</th>
                                    <th scope="col">Ngày đăng</th>
                                    <th scope="col">Hình ảnh</th>
                                    <th scope="col">Hành động</th>
                                    </thead>
                                    <tbody>
                                    @foreach($blog as $key =>$cate )
                                        <tr>
                                            <th scope="row">{{$key+1}}</th>
                                            <td>{{$cate->title}}</td>
                                            <td>{{ \Illuminate\Support\Str::limit($cate->description, 50, '...') }}</td>
                                            <td>
                                                @if($cate->status == 1)
                                                    <p class="text-success btn">Hiển thị </p>
                                                @elseif($cate->status == 0)
                                                    <p class="text-danger btn">Không hiện thị </p>
                                                @elseif($cate->status == 3)
                                                    <p class="text-danger btn">Từ chối</p>
                                                @else
                                                    <p class="text-warning btn">Đợi duyệt</p>
                                                @endif
                                            </td>
                                            <td>
                                                @if($cate->kind_of_blog == "blogs")
                                                    Blog
                                                @else
                                                    Hướng dẫn
                                                @endif
                                            </td>
                                            <td>{{$cate->created_at}}</td>
                                            <td><img width="200px" height="100px"
                                                     src="{{asset('uploads/blogs/'.$cate->image)}}" alt=""></td>
                                            <td>
                                                <a class="btn btn-secondary"
                                                   href="{{route('admin.blogs.preview_blogs',$cate->id)}}">xem Blogs</a>
                                                <a class="btn btn-warning"  href="{{route('admin.blogs.edit',$cate->id)}}">Sửa</a>
                                                {{--                                                @can('')--}}
                                                <form method="post"  action="{{route('admin.blogs.destroy',[$cate->id])}}">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button onclick="return confirm('Bạn có muốn xoá?')" class="btn btn-danger">Xoá</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                </th>
                            </tr>
                            </thead>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
