<?php

namespace App\Http\Controllers\API\V1\Public;

use App\Http\Controllers\Controller;
use App\Models\Travel;

class TravelController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $travels = Travel::whereIsPublic(true)->orderBy('created_at')->get();

        return \Response::json($travels);
    }
}
