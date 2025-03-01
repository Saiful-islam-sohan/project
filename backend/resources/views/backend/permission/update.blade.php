@extends('backend.master')
@section('title', 'update Page')

@section('admin-content')
<div class="container">
    <h1>Edit Permission</h1>

    <form action="{{ route('permission.update', $permission->id) }}" method="POST">
        @csrf
        @method('post')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $permission->name }}" required>
        </div>

        <button type="submit" class="mt-3 btn btn-primary">Update Permission</button>
    </form>
</div>
@endsection