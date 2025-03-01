@extends('backend.master')

@section('title', 'Create Role')

@section('admin-content')
<div class="container mt-4">
    <div class="p-4 shadow-lg card">
        <h2 class="mb-4">Create Role</h2>
        
        <form action="{{ route('role.store') }}" method="POST">
            @csrf
            
            <!-- Role Name Input -->
            <div class="mb-3">
                <label for="role-name" class="form-label fw-bold">Role Name:</label>
                <input type="text" name="name" id="role-name" class="form-control" required placeholder="Enter Role Name">
            </div>

            <!-- Permissions Selection -->
            <div class="mb-4">
                <h4 class="fw-bold">Assign Permissions</h4>
                <div class="row">
                    @foreach ($permissions->groupBy('group_by') as $group => $perms)
                        <div class="col-md-4">
                            <div class="p-3 mb-3 shadow-sm card">
                                <h5 class="text-primary">{{ ucfirst($group) }}</h5>
                                @foreach ($perms as $permission)
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="permissions[]" id="perm_{{ $permission->id }}" value="{{ $permission->id }}">
                                        <label for="perm_{{ $permission->id }}" class="form-check-label">{{ $permission->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-success w-100">Create Role</button>
        </form>
    </div>
</div>
@endsection
