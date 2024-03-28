@extends('be.layout')
@section('content')
<div class="col-lg-12">
    <h2>List San Pham</h2>
    <div class="text-right">
        <a class="btn btn-success" href="{{route('admin.product.add')}}">Thêm</a>
    </div>
    <div>
        <hr>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover" id="dataTable">
            <thead class="table">
                <tr>
                    <th>Id</th>
                    <th>Ten</th>
                    <th>Danh muc</th>
                    <th>Gia</th>
                    <th>So luong</th>
                    <th>Mo ta</th>
                    <th>Doanh so</th>
                    <th>So luot xem</th>
                    <th>sale</th>
                    <th>Thao tac</th>
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
                    <td scope="row"> {{$count}}</td>
                    <td> {{$item->name}}</td>
                    <td> {{ $item->category_id }}</td>
                    <td> {{ $item->price }}</td>
                    <td> {{ $item->quantity }}</td>
                    <td> {{ $item->description }}</td>
                    <td> {{ $item->sold }}</td>
                    <td>
                        <img style="width: 100px" src="{{$item->images[0]->path}}">
                    </td>
                    <td> {{ $item->sale_id }}</td>
                    <td>
                        <a class="btn btn-warning" href="{{route('admin.product.edit',['id'=>$item->id])}}">Sửa</a>
                        <a class="btn btn-danger" href="{{route('admin.product.delete',['id'=>$item->id])}}" onclick="return confirm('Bạn có muốn xoá ?')">Xóa</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection