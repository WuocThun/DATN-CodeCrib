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
                        <a href="{{route('admin.rooms_classification.create')}}" class="btn btn-success"> Thêm Danh mục phòng </a>
                        <table class="table">
                            <thead>
                            <tr>
                                <table id="myTable" class="table">
                                    <thead>
                                    <th scope="col">ID</th>
                                    <th scope="col">Tên danh mục</th>
                                    <th scope="col">Phòng</th>
                                    <th scope="col">Loại tin</th>
                                    <th scope="col">Quản lý</th>
                                    </thead>
                                    <tbody>
                                    @foreach($getRoomsClassification as $key =>$classification )
                                        <tr>
                                            <th scope="row">{{$key+1}}</th>
                                            <td>{{$classification->title}}</td>
                                            <td>{{ \Illuminate\Support\Str::limit($classification->description, 50, '...') }}</td>
                                            <td>{{$classification->room_id}}</td>

                                            <td>
                                                <a class="btn btn-warning"  href="{{route('admin.rooms_classification.edit',$classification->id)}}">Sửa</a>
                                                <form method="post"  action="{{route('admin.rooms_classification.destroy',[$classification->id])}}">
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
