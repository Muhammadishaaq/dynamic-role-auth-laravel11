<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    // Show all roles
    public function index()
    {
        $roles = Role::all();
        return view('partials.role.index', compact('roles'));
    }

    // Show form to create a new role
    public function create()
    {
        return view('partials.role.create');
    }

    // Store a new role
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:roles,name']);
        Role::create(['name' => $request->name]);
        return redirect()->route('roles.index')->with('success', 'Role created successfully!');
    }

    // Show form to edit a role
    public function edit(Role $role)
    {
        return view('partials.role.edit', compact('role'));
    }

    // Update the role
    public function update(Request $request, Role $role)
    {
        $request->validate(['name' => 'required|unique:roles,name,' . $role->id]);
        $role->update(['name' => $request->name]);
        return redirect()->route('roles.index')->with('success', 'Role updated successfully!');
    }

    // Delete the role
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully!');
    }

    public function assign($id)
    {
        // Find the role by ID
        $role = Role::findOrFail($id);
        // Get all available permissions
        $permissions = Permission::all();

        // Return the view with the role and available permissions
        return view('partials.role.assign', compact('role', 'permissions'));
    }

    // Handle assigning permissions to a role
    public function assignPermission(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        // Find the role by ID
        $role = Role::findOrFail($id);

        // Assign the permissions to the role
        $role->permissions()->sync($request->permissions);

        // Redirect back with a success message
        return redirect()->route('roles.index')->with('success', 'Permissions assigned successfully!');
    }
}

