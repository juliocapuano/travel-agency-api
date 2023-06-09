<?php

namespace App\Http\Controllers\API\V1\Public;

use App\Http\Controllers\Controller;
use App\Models\Travel;

class TourController extends Controller
{
    public function index(Travel $travel)
    {
        $tours = $travel->tours;

        return \Response::json($tours);
    }
}
