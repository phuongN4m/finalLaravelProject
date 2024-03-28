@extends('be.layout')
@section('content')
    <div class="col-lg-12">
        <h2>Sua San Pham</h2>
    </div>
    <div>
        <hr>
    </div>
    <div>
        <form action="{{route('admin.product.doEdit')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="id">id San Pham</label>
                <input type="number" class="form-control" id="id" name="id" value="{{$id}}" readonly>
            </div>
            <div class="form-group">
                <label for="name">Ten San Pham</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="">Loại danh mục</label>
                <select id="category_id" name="category_id" class="form-control">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="price">Gia</label>
                <input type="number" class="form-control" name="price" id="price">
            </div>
            <div class="form-group">
                <label for="quantity">So luong</label>
                <input type="number" class="form-control" name="quantity" id="quantity">
            </div>
            <div class="form-group">
                <label for="Description">Mo ta</label>
                <input type="text" class="form-control" name="description" id="description">
            </div>
            <div class="form-group">
                <label for="">Giảm giá</label>
                <select id="sale_id" name="sale_id" class="form-control">
                    @foreach($sales as $sale)
                        <option value="{{$sale->id}}">{{$sale->percent}}</option>
                    @endforeach
                </select>
            </div>
{{--            <div class="form-group">--}}
{{--                <label for="img">Ảnh</label>--}}
{{--                <input type="file" class="form-control" name="img[]" id="img" multiple>--}}
{{--            </div>--}}
            <button type="submit" class="btn btn-primary">Luu thay doi</button>
        </form>
    </div>
@endsection
