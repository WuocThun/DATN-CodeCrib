@extends('admin_core.layouts.test')

@section('main')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Thêm danh mục phòng </div>
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
                            <a href="{{route('admin.rooms_classification.index')}}" class="btn btn-warning">Tất cả danh mục </a>

                        <form action="{{route('admin.rooms_classification.update',$roomClass->id)}}" method="post" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên Danh mục</label>
                                <input type="text" name="title" value="{{$roomClass->title}}" class="form-control" placeholder="...."
                                       onkeyup="ChangeToSlug();" id="slug">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Slug</label>
                                <input type="text" name="slug" value="{{$roomClass->slug}}"  class="form-control" placeholder="...." id="convert_slug">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Description</label>
                                <textarea class="des_blog form-control ckeditor" name="description"
                                          id="des_blog"
                                          rows="3">{{$roomClass->description}} </textarea>
                            </div>

                            <button type="submit" class="btn btn-warning"> Sửa</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
