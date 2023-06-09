<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();

        return \Response::json($roles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valid_data = $request->validate([
            'name' => ['required'],
        ]);

        $role = Role::create($valid_data);

        return \Response::json($role, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return \Response::json($role);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $valid_data = $request->validate([
            'name' => ['required'],
        ]);

        $role->update($valid_data);

        return \Response::json($role, 202);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $count = $role->users()->count();
        abort_if($count, 'This role is in use');
        $role->delete();

        return \Response::noContent();
    }
}
