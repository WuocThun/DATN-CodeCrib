@extends('admin_core.layouts.test')
@section('main')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Danh sách tất cả người dùng</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <a href="{{route('admin.user.create')}}" class="btn btn-success"> Thêm người dùng </a>
                        <table class="table table-striped table-responsive">
                            <thead>
                            <tr>
                                <table id="myTable" class="table">
                                    <thead>
                                    <th scope="col">ID</th>
                                    <th scope="col">Tên User</th>
                                    <th scope="col">Email</th>
                                    {{--                                    <th scope="col">Password</th>--}}
                                    <th scope="col">Vai trò (roles)</th>
                                    <th scope="col">Quyền (permission)</th>
                                    <th scope="col">Quản lý</th>
                                    </thead>
                                    <tbody>
                                    @foreach($user as $key =>$us)
                                        <tr>
                                            <th>{{$us->id}}</th>
                                            <th>{{$us->name}}</th>
                                            <th>{{$us->email}}</th>
                                            <th>
                                                @foreach($us->roles as $key1 => $roles)
                                                    <span class="badge bg-info">{{$roles->name}}</span>
                                                @endforeach
                                            </th>
                                            <th>
                                                @foreach($roles->permissions as $key2 => $permissions)
                                                    <span class="badge bg-warning text-dark">{{$permissions->name}}</span>
                                                @endforeach
                                            </th>
                                            <th>
                                                <a href="{{route('admin.assgin',$us->id)}}" class="btn btn-warning">Phân
                                                    vai trò</a>
                                                <a href="{{route('admin.permission',$us->id)}}" class="btn btn-success">Phân
                                                    thêm quyền</a>
                                                <form method="post"  action="{{route('admin.users.delete',[$us->id])}}">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button onclick="return confirm('Bạn có muốn xoá?')" class="btn btn-danger">Xoá</button>
                                                </form>
                                            </th>
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
