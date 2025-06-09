<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{

    public function index()
    {
        $roles = Role::all();

        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();

        $selectedPermissions = [];

        return view('roles.create', compact('permissions', 'selectedPermissions'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'nullable|array',
            'permissions.*' => 'integer|exists:permissions,id',
        ]);

        $role = Role::create(['name' => $request->name]);

        if ($request->permissions) {
            $permissionNames = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();
            $role->syncPermissions($permissionNames);
        }

        return redirect()->route('roles.index')->with('success', 'Função criada com sucesso!');
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        $role = Role::findOrFail($id);

        $permissions = Permission::all();

        $selectedPermissions = $role->permissions->pluck('id')->toArray();

        return view('roles.edit', compact('role', 'permissions', 'selectedPermissions'));
    }

    public function update(Request $request, string $id)
    {
        $role = Role::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'nullable|array',
            'permissions.*' => 'integer|exists:permissions,id',
        ]);

        $role->update(['name' => $request->name]);

        if ($request->permissions) {
            $permissionNames = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();
            $role->syncPermissions($permissionNames);
        } else {
            $role->syncPermissions([]);
        }

        return redirect()->route('roles.index')->with('success', 'Função atualizada com sucesso!');
    }

    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Função removida com sucesso!');
    }

}
