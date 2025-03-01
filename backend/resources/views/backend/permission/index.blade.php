@extends('backend.master')
@section('title', 'Index Page')

@section('admin-content')
    <div class="container">
        <h1>Permissions</h1>
        <a href="{{ route('permission.create') }}" class="mb-3 btn btn-primary">Create Permission</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $permission)
                    <tr>
                        <td>{{ $permission->id }}</td>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                             <a href="{{ route('permission.edit', $permission->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('permission.delete', $permission->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            {{ $permissions->links() }}
        </div>
    </div>
@endsection
