@extends('be.layout')
@section('content')
<div class="col-lg-12">
    <h2>Danh Mục</h2>
    <div class="text-right">
        <a class="btn btn-success" href="{{route('admin.category.add')}}">Thêm</a>
    </div>
    <div>
        <hr>
    </div>
    <div>
        <table class="table" id="dataTable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên danh mục</th>
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
                    <td>
                        <a class="btn btn-warning" href="{{route('admin.category.edit', ['id'=> $item->id])}}">Sửa</a>
                        <a class=" btn btn-danger" href="{{route('admin.category.delete', ['id'=> $item->id])}}" onclick="confirm('Bạn có chắc chắn muốn xóa')">Xóa</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection