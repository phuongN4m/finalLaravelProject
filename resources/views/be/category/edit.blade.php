@extends('be.layout')

@section('content')
<div class="col-lg-12">
    <h2>Sua danh muc</h2>
    <div class="">
        <form action="{{route('admin.category.doEdit', $id)}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Ten</label>
                <input type="text" class="form-control" id="name" name="name" value="{{$data->name}}">
            </div>
            <button type="submit" class="btn btn-primary">Them</button>
        </form>
    </div>
</div>
@endsection