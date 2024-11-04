@extends('admin.layouts.app')
@section('navbar')
    @include('admin.inc.navbar')
@endsection
@section('main')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Danh Sách Phòng</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <a href="{{route('admin.rooms.create')}}" class="btn btn-success"> Thêm phòng </a>
                        <table class="table">
                            <thead>
                            <tr>
                                <table id="myTable" class="table">
                                    <thead>
                                    <th scope="col">ID</th>
                                    <th scope="col">Tên Phòng</th>
                                    <th scope="col">Mô tả</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Ngày đăng</th>
                                    <th scope="col">Hình ảnh</th>
                                    <th scope="col">Hành động</th>
                                    </thead>
                                    <tbody>
                                    @foreach($room as $key =>$myroom )
                                       <tr>
                                           <td>{{$myroom->id}}</td>
                                           <td>{{$myroom->title}}</td>
                                           <td>{{ \Illuminate\Support\Str::limit($myroom->description, 15, '...') }}</td>
                                           <td>
                                           @if($myroom->status == 1)
                                               <p class="text-success btn">Phòng đã được duyệt </p>
                                           @elseif($myroom->status == 0)

                                                   <p class="text-warning btn">Phòng đang đợi QTV duyệt</p>
                                           @elseif($myroom->status == 3)
                                               <p class="text-danger btn">Phòng đã bị từ chối</p>
                                           @else
                                                   <p class="text-danger btn">Phòng Không hiển thị </p>
                                           @endif
                                           </td>
                                           <td>{{$myroom->created_at}}</td>
                                           <td>
                                               @php
                                                   // Decode the JSON data for images
                                                   $images = json_decode($myroom->image, true);
                                               @endphp

                                               @if(!empty($images))
                                                   @if(count($images) === 1)
                                                       <!-- Display a single image -->
                                                       <img width="200px" height="100px" src="{{ asset('uploads/rooms/' . json_decode( $myroom->image)) }}" alt="Room Image">
                                                   @else
                                                       <!-- Bootstrap Carousel for Multiple Images -->
                                                       <div id="carousel-{{ $myroom->id }}" class="carousel slide" data-bs-ride="carousel">
                                                           <div class="carousel-inner">
                                                               @foreach($images as $index => $img)
                                                                   <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                                       <img width="200px" height="100px" src="{{ asset('uploads/rooms/' . $img) }}" alt="Room Image">
                                                                   </div>
                                                               @endforeach
                                                           </div>
                                                           <!-- Controls -->
                                                           <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $myroom->id }}" data-bs-slide="prev">
                                                               <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                               <span class="visually-hidden">Previous</span>
                                                           </button>
                                                           <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $myroom->id }}" data-bs-slide="next">
                                                               <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                               <span class="visually-hidden">Next</span>
                                                           </button>
                                                       </div>
                                                   @endif
                                               @else
                                                   <p>No images available</p>
                                               @endif
                                           </td>
                                           <td>
{{--                                               <a class="btn btn-secondary"--}}
{{--                                                  href="{{route('admin.blogs.preview_blogs',$myroom->id)}}">xem Blogs</a>--}}
                                               <a class="btn btn-warning"  href="{{route('admin.rooms.edit',$myroom->id)}}">Sửa</a>
                                               <form method="post"  action="{{route('admin.rooms.destroy',[$myroom->id])}}">
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
