@extends('be.layout')
@section('content')
    <div class="col-lg-12">
        <h2>Sửa Danh Mục</h2>
    </div>
    <div>
        <hr>
    </div>
    <div>
        <form action="{{route('admin.sale.doEdit')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">id</label>
                <input type="text" class="form-control" id="id" name="id" value="{{$data->id}}" readonly>
            </div>
            <div class="form-group">
                <label for="name">Tên danh mục</label>
                <input type="text" class="form-control" id="percent" name="percent" value="{{$data->percent}}">
            </div>
            <button type="submit" class="btn btn-primary">Sửa</button>
        </form>
    </div>
@endsection
