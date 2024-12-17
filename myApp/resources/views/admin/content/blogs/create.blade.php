@extends('admin_core.layouts.test')

@section('main')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Thêm blog </div>
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
                        @role('admin')
                            <a href="{{route('admin.blogs.index')}}" class="btn btn-warning">Tất cả bài viết </a>
                            @endrole
                            @role('admin|houseRenter|viewer')
                            <a href="{{route('admin.blogs.myblogs')}}" class="btn btn-success">Bài viết của tôi </a>
                            @endrole
                        <form action="{{route('admin.blogs.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tiêu đề</label>
                                <input type="text" name="title" class="form-control" placeholder="...."
                                       onkeyup="ChangeToSlug();" id="slug">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Slug</label>
                                <input type="text" name="slug"  class="form-control" placeholder="...." id="convert_slug">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Image</label> <br>
                                <input type="file" name="image" class="form-control-image" placeholder="...."
                                       id="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Description</label>
                                <textarea class="des_blog form-control ckeditor" name="description"
                                          id="des_blog"
                                          rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Content</label>
                                <textarea class=" form-control" required name="content"
                                          id="cont_blog" placeholder="..."
                                ></textarea>
                            </div>
                            @role('admin')
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Status</label>
                                <select class="form-control" name="status">
                                    <option value="1">Hiển thị</option>
                                    <option value="0">Không hiển thị</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Gửi</button>
                            @endrole
                            @role('houseRenter|viewer')
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Status</label>
                               <input name="status" hidden="" type="number"  value="2">
                            </div>
                            <button type="submit" class="btn btn-warning">Gửi bài cho quản trị viên</button>
                            @endrole
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
