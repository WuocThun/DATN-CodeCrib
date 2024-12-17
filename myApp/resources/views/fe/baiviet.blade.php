@extends('fe.layouts.app')
@section('title','Chi tiết bài viết')
@section('header')
    @include('fe.inc.header')
@endsection
@section('main')
    <style>
        .results-left {
            width: 70%; /* 70% for the left column */
            padding: 20px;
            border: 0.5px #b1adad solid;
        }
        .results-left h1 {
            font-size: 24px;
            font-weight: bold;
            text-align: left;
            color: #333;
            line-height: 1.4;
            margin-bottom: 20px;
        }

        .article-summary p {
            font-size: 16px;
            line-height: 1.6;
            color: #555;
            margin-bottom: 20px;
        }

        .article-main-content figure {
            margin: 20px 0;
            text-align: center;
        }

        .article-main-content figure img {
            max-width: 100%;
            height: auto;
        }

        .article-main-content h2 {
            font-size: 20px;
            margin: 20px 0;
            color: #333;
        }

        .article-main-content h3 {
            font-size: 18px;
            margin: 15px 0;
            font-style: italic;
            color: #444;
        }

        .article-main-content p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 15px;
            color: #555;
        }

        .article-tags {
            margin-top: 30px;
            padding: 10px 0;
            border-top: 1px solid #ddd;
        }

        .article-tags span {
            font-weight: bold;
            margin-right: 10px;
        }

        .tags-content span {
            display: inline-block;
            background-color: #eee;
            padding: 5px 10px;
            border-radius: 5px;
            color: #333;
        }
    </style>

    <section class="search-results">
        <div class="container search-results-container">
            <div class="results-left">
                <div>
                    <h1 class="text-2xl">Chi tiết tin:
                        {{$blog->title}}
                    </h1>

                    <div>

                    </div>
                    <div class="article-summary">
                        {{$blog->content}}
                    </div>
                    <div class="article-main-content">
                        <figure style="text-align: center">
                            <img
                                src="{{asset('uploads/blogs/'.$blog->image)}}"
                                alt={{$blog->title}}
                  width="960"
                                height="720"
                            />
                            <figcaption>
                                <em
                                >{{$blog->title}}</em
                                >
                            </figcaption>
                        </figure>
                        @php
                            echo ($blog->description)
                        @endphp
                    </div>
                    {{--            <div class="article-tags">--}}
                    {{--              <span>Từ khóa:</span>--}}
                    {{--              <div class="tags-content"><span>Tin tức thị trường</span></div>--}}
                    {{--            </div>--}}
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
