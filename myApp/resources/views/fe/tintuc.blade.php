@extends('fe.layouts.app')
@section('title','Tin tức')
@section('header')
    @include('fe.inc.header')
@endsection
@section('searchBar')
    @include('fe.inc.search_bar')
@endsection
@section('hotZone')
    @include('fe.inc.hot_zone')
@endsection
@section('main')
    <section class="search-results">
        <div class="container search-results-container">
            <div class="results-left">
                <div style="margin-bottom: 20px; ">
                    <a href="{{route('welcome')}}" style="text-decoration: none; ">Trang chủ</a> > Tin tức
                </div>
                <h2 style="margin-bottom: 20px;">Tin tức thị trường, chia sẻ kinh nghiệm Bất động sản</h2>
                @foreach($blogs as $key => $blog)

                <a href="{{route('getBlog',$blog->slug)}}" style="text-decoration: none;">
                    <div class="result-item">
                        <img src="{{asset('uploads/blogs/'.$blog->image)}}" alt="Ký túc xá Tân Bình">
                        <div class="result-info">
                            <h3>{{$blog->title}}</h3>
                            <p>{{ \Illuminate\Support\Str::limit($blog->content, 100)}}</p>
                            <div class="contact-options">

                            </div>
                        </div>
                    </div>
                </a>
                @endforeach

                <div class="pagination">
                    @if ($blogs->onFirstPage())
                        <button class="prev" disabled>« Trang trước</button>
                    @else
                        <a href="{{ $blogs->previousPageUrl() }}" class="prev">« Trang trước</a>
                    @endif

                    @for ($page = 1; $page <= $blogs->lastPage(); $page++)
                        <a href="{{ $blogs->url($page) }}" class="page {{ $page == $blogs->currentPage() ? 'active' : '' }}">{{ $page }}</a>
                    @endfor

                    @if ($blogs->hasMorePages())
                        <a href="{{ $blogs->nextPageUrl() }}" class="next">Trang sau »</a>
                    @else
                        <button class="next" disabled>Trang sau »</button>
                    @endif
                </div>
            </div>

           @include('fe.inc.fitler_blogs_right')

        </div>

    </section>

@endsection
@section('overView')
    @include('fe.inc.over_view')
@endsection
@section('footer')
    @include('fe.inc.footer')
@endsection

