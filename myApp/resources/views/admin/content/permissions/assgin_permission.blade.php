@extends('admin.layouts.app')
@section('navbar')
    @include('admin.inc.navbar')
@endsection
@section('main')
    <div class="container">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Cấp quyền cho User: <b> {{$user->name}}</b>
                </div>
                <form action="{{route('admin.insert_permission', $user->id)}}" method="post">
                    @csrf
                    @if(isset($name_roles))
                        Vai trò hiện tại của bạn: <b>{{$name_roles}}</b>
                    @endif
                    @foreach($permission as $key => $per)
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input"
                                   @foreach(@$get_permission_via_role as $key1 => $get)
                                       @if($get->id == $per->id)
                                           checked
                                   @endif

                                   @endforeach
                                   name="permission[]" multiple value="{{$per->name}}"
                                   id="{{$per->id}}">
                            <label class="form-check-label" for="{{$per->id}}">
                                {{$per->name}}
                            </label>
                        </div>
                    @endforeach
                    <br>

                    <input type="submit" name="insertRole" value="Cấp quyền cho User" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Thêm quyền cho user
                </div>
                <form action="{{route('admin.add_permisission')}}" method="post">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Thêm quyền</label>
                        <input type="text" name="name" class="form-control" placeholder="....">
                    </div>

                    <br>

                    <input type="submit" name="insertRole" value="Thêm quyền" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>

@endsection
