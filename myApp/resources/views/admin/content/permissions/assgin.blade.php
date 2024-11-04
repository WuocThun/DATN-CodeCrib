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
                <form action="{{route('admin.insert_roles', $user->id)}}" method="post">
                    @csrf
                    {{--                    <p>Vai trò hiện tại: {{$name_roles->name}}</p>--}}
                    @foreach($role as $key => $r)
                        @if(isset($all_collum_roles))

                            <div class="form-check form-check-inline">
                                <input class="form-check-input"
                                       {{$r->id==$all_collum_roles->id ? 'checked' : ''}}  type="radio" name="role"
                                       id="{{$r->id}}" value="{{$r->name}}">
                                <label class="form-check-label" for="{{$r->id}}">{{$r->name}} </label>
                            </div>
                        @else
                            <div class="form-check form-check-inline">
                                <input class="form-check-input"
                                       type="radio" name="role"
                                       id="{{$r->id}}" value="{{$r->name}}">
                                <label class="form-check-label" for="{{$r->id}}">{{$r->name}} </label>
                            </div>
                        @endif
                    @endforeach
                    <br>
                    {{--                    @foreach($permission as $key => $per)--}}
                    {{--                    <div class="form-check">--}}
                    {{--                        <input type="checkbox" class="form-check-input" name="" value="{{$per->name}}" id="{{$per->id}}" >--}}
                    {{--                        <label class="form-check-label" for="{{$per->id}}">--}}
                    {{--                            {{$per->name}}--}}
                    {{--                        </label>--}}
                    {{--                    </div>--}}
                    {{--                    @endforeach--}}
                    <input type="submit" name="insertRole" value="Cấp vai trò cho User" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
@endsection
