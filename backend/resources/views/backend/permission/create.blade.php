@extends('backend.master')
@section('title', 'Create Permission')

@section('admin-content')
<div class="container">
    <h1>Create Permission</h1>

    <form action="{{ route('permission.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <button type="submit" class="mt-3 btn btn-success">Create Permission</button>
    </form>
</div>
@endsection