<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();

        return \Response::json($roles);
    }

    public function store(Request $request)
    {
        $valid_data = $request->validate([
            'name' => ['required'],
        ]);

        $role = Role::create($valid_data);

        return \Response::json($role, 201);
    }

    public function show(Role $role)
    {
        return \Response::json($role);
    }

    public function update(Request $request, Role $role)
    {
        $valid_data = $request->validate([
            'name' => ['required'],
        ]);

        $role->update($valid_data);

        return \Response::json($role, 202);
    }

    public function destroy(Role $role)
    {
        $count = $role->users()->count();
        abort_if($count, 'This role is in use');
        $role->delete();

        return \Response::noContent();
    }
}
