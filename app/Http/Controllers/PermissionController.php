<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    // Show all permissions
    public function index()
    {
        $permissions = Permission::all();
        return view('partials.permission.index', compact('permissions'));
    }

    // Show form to create a new permission
    public function create()
    {
        return view('partials.permission.create');
    }

    // Store a new permission
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:permissions,name']);
        Permission::create(['name' => $request->name]);
        return redirect()->route('permissions.index')->with('success', 'Permission created successfully!');
    }

    // Show form to edit a permission
    public function edit(Permission $permission)
    {
        return view('partials.permission.edit', compact('permission'));
    }

    // Update the permission
    public function update(Request $request, Permission $permission)
    {
        $request->validate(['name' => 'required|unique:permissions,name,' . $permission->id]);
        $permission->update(['name' => $request->name]);
        return redirect()->route('permissions.index')->with('success', 'Permission updated successfully!');
    }

    // Delete the permission
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully!');
    }
}
