@extends('be.layout')

@section('content')
<div class="col-lg-12">
    <h2>Thay Doi Thong Tin</h2>
    <form action="{{route('admin.user.doEdit')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="id">ID</label>
            <input type="number" class="form-control" id="id" name="id" value="{{$id}}" readonly>
        </div>
        <div class="form-group">
            <label for="name">Ten</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$data->name}}">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{$data->email}}">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="number" class="form-control" id="phone" name="phone" value="{{$data->phone}}">
        </div>
        <div class="form-group">
            <label for="img">Image</label>
            <input type="file" class="form-control" id="img" name="img" value="">
        </div>
        <button type="submit" class="btn btn-primary">Luu Thay Doi</button>
    </form>
</div>
@endsection