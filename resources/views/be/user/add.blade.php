@extends('be.layout')

@section('content')
<div class="col-lg-12">
    <h2>Them Nguoi Dung</h2>
    <div class="">
        <form action="{{route('admin.user.doAdd')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Ten</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="tel" class="form-control" id="phone" name="phone">
            </div>
            <div class="form-group">
                <label for="img">Image</label>
                <input type="file" class="form-control" id="img" name="img">
            </div>
            <button type="submit" class="btn btn-primary">Them</button>
        </form>
    </div>
</div>


@endsection