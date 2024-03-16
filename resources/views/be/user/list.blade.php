@extends('be.layout')
@section('content')
<div class="col-lg-12">
    <h2>Danh Sach Nguoi Dung</h2>
    <div class="text-right">
        <a class="btn btn-success" href="{{route('admin.user.add')}}">Thêm</a>
    </div>
    <div>
        <hr>
    </div>
    <div>
        <table class="table" id="dataTable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên người dùng</th>
                    <th scope="col">Email</th>
                    <th scope="col">Số Điện Thoại</th>
                    <th scope="col">Level</th>
                    <th scope="col">Avatar</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @php
                $count = 0;
                @endphp
                @foreach($list as $item)
                @php
                $count+= 1;
                @endphp
                <tr>
                    <th scope="row">{{$count}}</th>
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->phone}}</td>
                    @if ($item->level === 1)
                    <td>Admin</td>
                    @else
                    <td>User</td>
                    @endif
                    <td>
                        <img src="{{ $item->images->path }}" style="width: 40px; height: 40px; border-radius: 50%">
                    </td>
                    <td>
                        <a class="btn btn-warning" href="{{route('admin.user.edit', ['id'=> $item->id])}}">Sửa</a>
                        <a class=" btn btn-danger" href="{{route('admin.user.delete', ['id'=> $item->id])}}" onclick="confirm('Bạn có chắc chắn muốn xóa')">Xóa</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection