@extends('be.layout')
@section('content')
<div class="col-lg-12">
    <h2>Danh Mục</h2>
    <div class="text-right">
        <a class="btn btn-success" href="{{route('admin.sale.add')}}">Thêm</a>
    </div>
    <div>
        <hr>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover" id="dataTable">
            <thead class="table">
                <tr>
                    <th>Id</th>
                    <th>Giảm giá (%)</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($list as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->percent}}</td>
                    <td>
                        <a class="btn btn-warning" href="{{route('admin.sale.edit',['id'=>$item->id])}}">Sửa</a>
                        <a class="btn btn-danger" href="{{route('admin.sale.delete',['id'=>$item->id])}}" onclick="return confirm('Bạn có muốn xoá ?')">Xóa</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection