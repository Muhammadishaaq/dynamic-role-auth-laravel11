<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();  
        return view('modules.partials.role.index', compact('roles'));
    }


    public function create()
    {
        $permissions = Permission::all();
        return view('modules.partials.role.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role = Role::create(['name' => $request->name]);
        $role->permissions()->sync($request->permissions);

        return redirect()->route('roles.index')->with('success', 'Role created and permissions assigned successfully!');
    }

    public function edit(Role $role)
    {
        return view('modules.partials.role.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate(['name' => 'required|unique:roles,name,' . $role->id]);
        $role->update(['name' => $request->name]);
        return redirect()->route('roles.index')->with('success', 'Role updated successfully!');
    }
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully!');
    }

    public function assign($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('modules.partials.role.assign', compact('role', 'permissions'));
    }
    public function assignPermission(Request $request, $id)
    {
        $request->validate([
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ]);
        $role = Role::findOrFail($id);
        $role->permissions()->sync($request->permissions);
        return redirect()->route('roles.index')->with('success', 'Permissions assigned successfully!');
    }
}

