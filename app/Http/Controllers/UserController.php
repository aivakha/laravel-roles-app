<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'ASC')->get();

        return view('users.index', compact(
            ['users']
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::orderBy('created_at', 'ASC')->get();

        return view('users.create', compact([
            'roles',
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
            'user_name' => 'required|max:255',
            'user_email' => 'required|email',
            'role_id' => 'required|exists:roles,id'
        ]);

        $user = User::create([
            'name' => $request->user_name,
            'email' => $request->user_email,
            'password'=> 'qweqwe',
        ]);

        $role = Role::findOrFail($request->role_id);

        $user->assignRole($role);

        return redirect()->back()->with('status', 'User has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::orderBy('created_at', 'ASC')->get();
        $user = User::findOrFail($id);

        return view('users.edit', compact(
            ['roles', 'user']
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'role_id' => 'required|integer|exists:roles,id'
        ]);

        $user = User::findOrFail($id);

        $role = Role::findOrFail($request->role_id);
        $user->update([
            'name' => $request->name
        ]);

        $user->syncRoles($role);

        return redirect()->back()->with('status', 'User has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('status', 'User has been deleted');
    }
}
