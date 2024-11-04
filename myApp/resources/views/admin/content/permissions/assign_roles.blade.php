@extends('admin.layouts.app')
@section('navbar')
    @include('admin.inc.navbar')
@endsection
@section('main')
    <div class="container">
        <h1 class="text-2xl">Phân Quyền</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
            <tr>
                <th>Người dùng</th>
                <th>Quyền</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>
                        @foreach($user->roles as $role)
                            <span class="">{{ $role->name }}|</span>
                        @endforeach
                    </td>
                    <td>
{{--                        <form action="{{ route('admin.assignRole', $user->id) }}" method="POST" style="display: inline;">--}}
{{--                        @csrf--}}
{{--                            <select name="role" required>--}}
{{--                                <option value="">Cấp quyền</option>--}}
{{--                                @foreach($roles as $role1)--}}
{{--                                    <option value="{{ $role1->name }}">{{ $role1->name }}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                            <button type="submit" class="btn btn-primary">Cấp quyền</button>--}}
{{--                        </form>--}}

                        <form action="{{ route('admin.revokeRole', $user->id) }}" method="POST" style="display: inline;">
                            @csrf
                            <select name="role" required>
                                <option value="">Gỡ quyền</option>
                                @foreach($user->roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-danger">Gỡ</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
