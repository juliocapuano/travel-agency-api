<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\Travel;
use Illuminate\Http\Request;

class TourController extends Controller
{
    public function index(Travel $travel)
    {
        $tours = $travel->tours;

        return \Response::json($tours);
    }

    public function store(Request $request, Travel $travel)
    {
        $valid_data = $request->validate([
            'name'          => ['required'],
            'starting_date' => ['required', 'date'],
            'ending_date'   => ['required', 'date'],
            'price'         => ['required', 'numeric'],
        ]);

        $tour = $travel->tours()->create($valid_data);

        return \Response::json($tour, 201);
    }

    public function show(Travel $travel, Tour $tour)
    {
        return \Response::json($tour);
    }

    public function update(Request $request, Travel $travel, Tour $tour)
    {
        $valid_data = $request->validate([
            'name'          => ['required'],
            'starting_date' => ['required', 'date'],
            'ending_date'   => ['required', 'date'],
            'price'         => ['required', 'numeric'],
        ]);

        $tour->update($valid_data);

        return \Response::json($tour, 202);
    }

    public function destroy(Travel $travel, Tour $tour)
    {
        $tour->delete();

        return \Response::noContent();
    }
}
