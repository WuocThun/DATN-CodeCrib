@extends('admin_core.layouts.test')

@section('main')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Cập nhật bài viết </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            @if($blog->status == 3)
                                <p class="text-danger">Lý do từ chối: {{ $blog->reject_reason }}</p>
                            @endif

                            @role('admin')
                            <a href="{{route('admin.blogs.index')}}" class="btn btn-info">Danh sách bài viết </a>
                            @endrole
                            @role('houseRenter|viewer')
                            <a href="{{route('admin.blogs.myblogs')}}" class="btn btn-info">Danh sách bài viết </a>

                            @endrole
                        <a href="{{route('admin.blogs.create')}}" class="btn btn-success">Thêm bài viết </a>

                        <form action="{{route('admin.blogs.update',$blog->id)}}" method="post"
                              enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Title</label>
                                <input type="text" name="title" required class="form-control" value="{{$blog->title}}"
                                       onkeyup="ChangeToSlug();" id="slug">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">slug</label>
                                <input type="text"  name="slug" required class="form-control" value="{{$blog->slug}}"
                                       id="convert_slug">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Image</label> <br>

                                <input type="file" name="image" class="form-control-image" id="">
                                <img width="200px" height="100px"
                                     src="{{asset('uploads/blogs/'.$blog->image)}}" alt="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Description</label>
                                <textarea class="des_blog form-control ckeditor"  name="description"
                                          id="des_blog"
                                          rows="3">{{$blog->description}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Content</label>
                                <textarea class="form-control" required name="content"
                                          id="exampleFormControlTextarea1"
                                          rows="3">{{$blog->content}}</textarea>
                            </div>
                            @role('admin')
                            <div class="form-group">
                                <input name="status" hidden="" type="number"  value="1">
                            </div>
                            @endrole
                            @role('houseRenter|viewer')
                            <div class="form-group">
                                <input name="status" hidden="" type="number"  value="2">
                            </div>
                            @endrole
                            <br>
                            @if($blog->status == 3 )
                            <button type="submit" class="btn btn-danger">Sửa lỗi</button>
                            @else
                                <button type="submit" class="btn btn-primary">Chỉnh sửa</button>
                            @endif
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
