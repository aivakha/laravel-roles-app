<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::orderBy('name')->where('name', '!=', 'super-user')->get();

        return view('roles.index', compact([
            'roles'
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::orderBy('name')->get();

        return view('roles.create', compact([
            'permissions'
        ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'permissions.*' => 'required|integer|exists:permissions,id'
        ]);

        $newRole = Role::create([
            'name' => $request->title
        ]);

        $permissions = Permission::whereIn('id', $request->permissions)->get();

        $newRole->syncPermissions($permissions);

        return redirect()->back()->with('status', 'Role has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::orderBy('name')->get();

        $role = Role::where('name', '!=', 'super-user')->findOrFail($role->id);

        return view('roles.edit', compact([
            'permissions',
            'role'
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'title' => 'required|max:255',
            'permissions' => 'required',
            'permissions.*' => 'required|integer|exists:permissions,id'
        ]);


        $permissions = Permission::whereIn('id', $request->permissions)->get();

        $role = Role::where('name', '!=', 'super-user')->findOrFail($role->id);

        $role->update([
            'name' => $request->title
        ]);

        $role->syncPermissions($permissions);

        return redirect()->back()->with('status', 'Role has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->back()->with('status', 'Role has been deleted');
    }
}
