@extends('admin.layouts.app')
@section('navbar')
    @include('admin.inc.navbar')
@endsection
@section('main')
    <div class="container">
    <p class="fs-1">Xin chào {{Auth::user()->name}}</p>
        <p>Bạn đang là
        @role('admin')
            Admin của web
        @endrole
            @role('houseRenter')
            Admin của web
        @endrole
        </p>
    </div>
@endsection
