@extends('admin_core.layouts.test')
{{--@section('navbar')--}}
{{--    @include('admin.inc.navbar')--}}
{{--@endsection--}}
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

                        <a href="{{route('admin.roomsCore.createCore')}}" class="btn btn-success"> Thêm tin phòng mới </a>
                        <table class="table">
                            <thead>
                            <tr>
                                <table id="myTable" class="table">
                                    <thead>
                                    <th scope="col">ID</th>
                                    <th scope="col">Tên Phòng</th>
                                    <th scope="col">Gói Vip</th>
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
{{--                                           <td>{{ \Illuminate\Support\Str::limit($myroom->description, 15, '...') }}</td>--}}
                                           <td class="btn align-middle">{{ $myroom->vipPackage ? $myroom->vipPackage->name : 'Không có gói VIP' }}</td> <!-- Hiển thị tên gói VIP -->
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
{{--                                               <a class="btn btn-warning"  href="{{route('admin.rooms.edit',$myroom->id)}}">Sửa</a>--}}

{{--                                               <button class="btn btn-primary" data-bs-toggle="modal"--}}
{{--                                                       data-bs-target="#exampleModal{{$myroom->id}}">--}}
{{--                                                   Mua VIP                                               </button>--}}
{{--                                               <div class="modal fade" id="exampleModal{{$myroom->id}}" tabindex="-1"--}}
{{--                                                    aria-labelledby="exampleModal{{$myroom->id}}" aria-hidden="true">--}}
{{--                                                   <div class="modal-dialog">--}}
{{--                                                       <div class="modal-content">--}}
{{--                                                           <div class="modal-header">--}}
{{--                                                               <h5 class="modal-title" id="exampleModal{{$myroom->id}}">Thông tin hoá đơn</h5>--}}
{{--                                                               <button type="button" class="btn-close" data-bs-dismiss="modal"--}}
{{--                                                                       aria-label="Close"></button>--}}
{{--                                                           </div>--}}
{{--                                                           <div class="modal-body">--}}
{{--                                                               <div class="container">--}}
{{--                                                                   @foreach($vipPackages as $package)--}}
{{--                                                                       <div class="card mb-3">--}}
{{--                                                                           <div class="card-body">--}}
{{--                                                                               <h3 class="card-title">{{ $package->name }}</h3>--}}
{{--                                                                               <p class="card-text"><strong>Giá:</strong> {{number_format($package->price,0,',', '.')}} VND</p>--}}
{{--                                                                               <p class="card-text"><strong>Thời gian:</strong> {{ $package->duration_days }} ngày</p>--}}
{{--                                                                               <p class="card-text"><strong>Lượt xem tăng:</strong> {{ $package->boosted_views }}</p>--}}

{{--                                                                               <!-- Form để mua gói VIP -->--}}
{{--                                                                               <form action="{{ route('admin.vip.purchase', [$myroom->id,$package->id]) }}" method="POST">--}}
{{--                                                                                   @csrf--}}
{{--                                                                                   <input type="hidden" name="vip_package_id" value="{{ $package->id }}">--}}
{{--                                                                                   <button type="submit" class="btn btn-primary">Mua Gói</button>--}}
{{--                                                                               </form>--}}
{{--                                                                           </div>--}}
{{--                                                                       </div>--}}
{{--                                                                   @endforeach--}}
{{--                                                               </div>--}}

{{--                                                           </div>--}}
{{--                                                           <div class="modal-footer">--}}
{{--                                                               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
{{--                                                               <button type="button" class="btn btn-primary">Save changes</button>--}}
{{--                                                           </div>--}}
{{--                                                       </div>--}}
{{--                                                   </div>--}}
{{--                                               </div>--}}<!-- Nút Mua VIP -->
                                               <a class="btn btn-warning"  href="{{route('admin.rooms.edit',$myroom->id)}}">Sửa</a>

                                               <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $myroom->id }}">
                                                   Mua VIP
                                               </button>

                                               <!-- Modal -->
                                               <div class="modal fade" id="exampleModal{{ $myroom->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $myroom->id }}" aria-hidden="true">
                                                   <div class="modal-dialog">
                                                       <div class="modal-content">
                                                           <div class="modal-header">
                                                               <h5 class="modal-title" id="exampleModalLabel{{ $myroom->id }}">Thông tin hoá đơn</h5>
                                                               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                           </div>
                                                           <div class="modal-body">
                                                               <div class="container">
                                                                   @foreach($vipPackages as $package)
                                                                       <div class="card mb-3">
                                                                           <div class="card-body">
                                                                               <h3 class="card-title">{{ $package->name }}</h3>
                                                                               <p class="card-text"><strong>Giá:</strong> {{ number_format($package->price, 0, ',', '.') }} VND</p>
                                                                               <p class="card-text"><strong>Thời gian:</strong> {{ $package->duration_days }} ngày</p>
                                                                               <p class="card-text"><strong>Lượt xem tăng:</strong> {{ $package->boosted_views }}</p>

                                                                               <!-- Form để mua gói VIP -->
                                                                               <form action="{{ route('admin.vip.purchase', [$myroom->id, $package->id]) }}" method="POST">
                                                                                   @csrf
                                                                                   <!-- Truyền room_id và vip_package_id vào form -->
                                                                                   <input type="hidden" name="room_id" value="{{ $myroom->id }}">
                                                                                   <input type="hidden" name="vip_package_id" value="{{ $package->id }}">
                                                                                   <button type="submit" class="btn btn-primary">Mua Gói</button>
                                                                               </form>
                                                                           </div>
                                                                       </div>
                                                                   @endforeach
                                                               </div>
                                                           </div>
                                                           <div class="modal-footer">
                                                               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                               <button type="button" class="btn btn-primary">Lưu thay đổi</button>
                                                           </div>
                                                       </div>
                                                   </div>
                                               </div>


                                               {{--                                               <a class="btn btn-primary"  href="{{route('admin.vip.packages',$myroom->id)}}">Kích hoạt vip</a>--}}

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
