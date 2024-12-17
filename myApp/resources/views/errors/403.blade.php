@extends('fe.layouts.app')
@section('searchBar')
    @include('fe.inc.search_bar')
@endsection
@section('main')
    <style>


        .con-404 {
            max-width: 600px;
            padding: 20px;
            background: #fff;
            /*border-radius: 15px;*/
            /*box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);*/
            animation: fadeIn 1s ease-in-out;
        }

        .h1-404 {
            font-size: 5rem;
            margin: 0;
            color: #ff6f61;
        }
        .h2-404 {
            text-align: center;
            font-size: 1rem;
            margin: 0;
        }

        .p-404 {
            text-align: center;
            font-size: 1rem;
            margin: 15px 0;
            color: #666;
        }

        .home-button {
            text-align: center;
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 1rem;
            text-decoration: none;
            background: #ff6f61;
            color: #fff;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .home-button:hover {
            background: #e65b50;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

    </style>
    <div class="container con-404">
        <h1 class="h1-404">403</h1>
        <h2 class="h2-404">Không tìm thấy đường dẫn này
        </h2>
    </div>
@endsection

@section('footer')
    @include('fe.inc.footer')
@endsection

