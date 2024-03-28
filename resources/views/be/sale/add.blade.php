@extends('be.layout')
@section('content')
    <div class="col-lg-12">
        <h2>Thêm Danh Mục</h2>
    </div>
    <div>
        <hr>
    </div>
    <div>
        <form action="{{route('admin.sale.doAdd')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Giảm giá (%)</label>
                <input type="number" class="form-control" id="percent" name="percent">
            </div>
            <button type="submit" class="btn btn-primary">Thêm</button>
        </form>
    </div>
@endsection
