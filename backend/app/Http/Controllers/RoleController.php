<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission ;

class RoleController extends Controller
{
    public function index()
    {
        
        $roles = Role::latest()->paginate(10);
        return view ('backend.role.index',compact('roles'));
            
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
       $permissions = Permission::orderBy('name', 'ASC')->get();

        return view('backend.role.create',compact('permissions'));
    }

   
    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required|unique:roles|max:255',
            'permissions' => 'array',
        ]);
    
       
        $role = Role::create(['name' => $request->name]);
    
        
        if (!empty($request->permissions)) {
            
            $permissions = Permission::whereIn('id', $request->permissions)->pluck('name');
            $role->givePermissionTo($permissions);
        }

        return redirect()->route('role.index')->with('success', 'Role created successfully!');
        
    }

  
    public function show(string $id)
    {
        //
    }

  
    public function edit(string $id)
    {
       
        $role = Role::findOrFail($id);
        $hasPermissions = $role->permissions->pluck('name')->toArray();  // Convert collection to array
        $permissions = Permission::orderBy('name', 'ASC')->get();
    
        return view('backend.role.update', compact(['role', 'permissions', 'hasPermissions']));
    }

   
    public function update(Request $request, string $id)
    {
        
        $validatedData = $request->validate([
            'name' => 'required|max:255|unique:roles,name,' . $id,
        ]);
    

        $role = Role::findOrFail($id);
    

        $role->name = $request->name;
        $role->save();
    
    
        if ($request->has('permissions')) {
            
            $permissionIds = Permission::whereIn('id', $request->permissions)->pluck('id')->toArray();
    
            $role->syncPermissions($permissionIds);
        }
    
        
        return redirect()->route('role.index')->with('success', 'Role updated successfully!');
    }
    
    

    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role->permissions()->detach();

        $role->delete();
    
        return redirect()->route('role.index')->with('success', 'Role deleted successfully!');
    }
}
