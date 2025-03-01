@extends('backend.master')

@section('title', 'Edit Role')

@section('admin-content')
<div class="container">
    <h2>Edit Role</h2>
    <form method="POST" action="{{ route('role.update', $role->id) }}" method="POST">
        @csrf
        @method('POST')

        <label>Role Name:</label>
        <input type="text" name="name" class="form-control" value="{{ $role->name }}" required>

        <h3 class="mt-3">Permissions</h3>
        @foreach ($permissions as $permission)
            <div>
                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" 
                    @if(in_array($permission->name, $hasPermissions)) checked @endif>
                <label for="">{{ $permission->name }}</label>
            </div>
        @endforeach

        <button type="submit" class="mt-2 btn btn-primary">Update Role</button>
    </form>
</div>
@endsection
