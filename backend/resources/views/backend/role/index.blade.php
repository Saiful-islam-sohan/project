@extends('backend.master')

@section('title', 'Roles Management')

@section('admin-content')
<div class="container mt-4">
    <div class="shadow-lg card">
        <div class="text-white card-header bg-primary">
            <h3 class="mb-0">Roles Management</h3>
        </div>
        <div class="card-body">
            <a href="{{ route('role.create') }}" class="mb-3 btn btn-success">
                <i class="fas fa-plus"></i> Create New Role
            </a>

            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead class="table-dark">
                        <tr class="text-center">
                            <th>#</th>
                            <th>Role Name</th>
                            <th>Permissions</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                        <tr class="text-center">
                            <td>{{ $role->id }}</td>
                            <td><strong>{{ ucfirst($role->name) }}</strong></td>
                            <td>
                                @if($role->permissions->isNotEmpty())
                                    @foreach($role->permissions as $permission)
                                        <span class="badge bg-info text-dark">{{ $permission->name }}</span>
                                    @endforeach
                                @else
                                    <span class="text-muted">No Permissions</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('role.edit', $role->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('role.delete', $role->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this role?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination Links -->
                <div class="d-flex justify-content-center">
                    {{ $roles->links() }}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
