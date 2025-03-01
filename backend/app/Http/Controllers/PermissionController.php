<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission ;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions= Permission::orderBy('created_at', 'DESC')->latest()->paginate(10);
        return view('backend.permission.index',compact('permissions')) ;
    }

  
    public function create()
    {
        return view('backend.permission.create');
    }

  
    public function store(Request $request)
    {
        //dd($request->all());
       $validateData= $request->validate([
            'name' => 'required|unique:permissions|string|max:255',
        ]);
        
         
        Permission::create($validateData);
          

        return redirect()->route('permission.index');
    }

  
    public function show(string $id)
    {
        //
    }

    
    public function edit(string $id)
    {
        $permission= Permission::findOrFail($id);
        
        return view('backend.permission.update', compact('permission'));
    }

   
    public function update(Request $request, string $id)
    {
        $permission= Permission::findOrFail($id);
        $validateData= $request->validate([
            'name' => 'required|unique:permissions|string|max:255',
        ]);

        //dd($validateData);

        $permission->update($validateData);
        
        return redirect()->route('permission.index');
    }

 
    public function destroy(string $id)
    {
       $permission= Permission::find($id);
         $permission->delete();
         return redirect()->route('permission.index');
    }
}
