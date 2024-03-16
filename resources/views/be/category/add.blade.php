@extends('be.layout')

@section('content')
<div class="col-lg-12">
    <h2>Them danh muc</h2>
    <div class="">
        <form action="{{route('admin.category.doAdd')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Ten</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <button type="submit" class="btn btn-primary">Them</button>
        </form>
    </div>
</div>


@endsection