@extends('be.layout')
@section('content')
<div class="col-lg-12">
    <h2>Thêm tài khoản</h2>
</div>
<div>
    <hr>
</div>
<div>
    <form action="{{route('admin.product.doAdd')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="">Loại danh mục</label>
            <select id="category_id" name="category_id" class="form-control">
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="name">Tên</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="form-group">
            <label for="price">Giá</label>
            <input type="number" class="form-control" id="price" name="price">
        </div>

        <div class="form-group">
            <label for="quantity">Số lượng</label>
            <input type="number" class="form-control" id="quantity" name="quantity">
        </div>
        <div class="form-group">
            <label for="sale">Giảm giá</label>
            <select id="sale_id" name="sale_id" class="form-control">
                @foreach($sales as $sale)
                <option value="{{$sale->id}}">{{$sale->percent}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="img">Image</label>
            <input type="file" class="form-control" id="img" name="img[]" multiple>
        </div>
        <div class="form-group">
            <label for="description">Mô tả</label>
            <textarea class="form-control ckeditor" id="editor" name="description" value=""></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
    </form>
</div>
@endsection