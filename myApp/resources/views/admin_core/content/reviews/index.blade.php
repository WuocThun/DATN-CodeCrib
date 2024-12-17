@extends('admin_core.layouts.test')

@section('main')
    <main role="main" class="ml-sm-auto col">

        @include('admin_core.inc.sub_main')
        <div class="container mt-5">
            <h1 class="mb-4">Danh sách góp ý</h1>
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Số sao</th>
                    <th>Rating</th>
                    <th>Nội dung</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($reviews as $review)
                    <tr>
                        <td>{{ $review->id }}</td>
                        <td>{{ $review->name }}</td>
                        <td>{{ $review->email }}</td>
                        <td>{{ $review->rating }}</td>

                        <td>{{ $review->comment }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </main>

@endsection
