<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Travel;
use Illuminate\Http\Request;

class TravelController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $travels = Travel::whereIsPublic(true)
            ->orderBy('created_at')
            ->get();

        return \Response::json($travels);
    }

    public function store(Request $request)
    {
        $valid_data = $request->validate([
            'is_public'      => ['required', 'boolean'],
            'name'           => ['required'],
            'description'    => ['required'],
            'number_of_days' => ['required', 'numeric'],
        ]);

        $travel = Travel::create($valid_data);

        return \Response::json($travel, 201);
    }

    public function show(Travel $travel)
    {
        return \Response::json($travel);
    }

    public function update(Request $request, Travel $travel)
    {
        $valid_data = $request->validate([
            'is_public'      => ['required', 'boolean'],
            'name'           => ['required'],
            'description'    => ['required'],
            'number_of_days' => ['required', 'numeric'],
        ]);

        $travel->update($valid_data);

        return \Response::json($travel, 202);
    }

    public function destroy(Travel $travel)
    {
        abort_if($travel->tours()->count() > 0, 422, 'This Travel has registered Tours');

        $travel->delete();

        return \Response::noContent();
    }
}
