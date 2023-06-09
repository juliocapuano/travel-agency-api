<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return Response::json($users);
    }

    public function store(Request $request)
    {
        $valid_data = $request->validate([
            'name'     => ['required'],
            'email'    => ['required', 'email'],
            'password' => ['required', $this->passwordRule()],
        ]);

        $valid_data['password'] = \Hash::make($valid_data['password']);

        $user = User::create($valid_data);

        return \Response::json($user, 201);
    }

    public function show(User $user)
    {
        return \Response::json($user);
    }

    public function update(Request $request, User $user)
    {
        $valid_data = $request->validate([
            'name'     => ['required'],
            'email'    => ['required', 'email'],
            'password' => ['nullable', $this->passwordRule()],
        ]);

        if ($valid_data['password'] ?? false) {
            $valid_data['password'] = \Hash::make($valid_data['password']);
        } else {
            unset($valid_data['password']);
        }

        $user->update($valid_data);

        return Response::json($user, 202);
    }

    public function destroy(User $user)
    {
        $user->roles()->detach();

        $user->delete();

        return \Response::noContent();
    }

    private function passwordRule(): Password
    {
        return (new Password(8))
            ->uncompromised(2)
            ->mixedCase();
    }
}
