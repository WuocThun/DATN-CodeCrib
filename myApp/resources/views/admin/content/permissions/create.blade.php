@extends('admin_core.layouts.test')

@section('main')
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Thêm Người dùng </div>
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
                    <a href="{{route('admin.user.index')}}" class="btn btn-success">Danh sách người dùng </a>
                    <form action="{{route('admin.user.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên User</label>
                            <input type="text" name="name"  class="form-control" placeholder="Tên người dùng">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="text" name="email"  class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="text" name="password"  class="form-control" placeholder="Mật khẩu">
                        </div>
                        <button type="submit" name="addUser" class="btn btn-primary">Thêm người dùng</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    </div>@endsection
