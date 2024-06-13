<?php

namespace App\Http\Controllers;

use App\Services\GoogleDistanceMatrixService;
use Illuminate\Http\Request;

class DistanceMatrixController extends Controller
{
    protected $googleDistanceMatrix;

    public function __construct(GoogleDistanceMatrixService $googleDistanceMatrix)
    {
        $this->googleDistanceMatrix = $googleDistanceMatrix;
    }

    public function getDistances(Request $request)
    {
        $origins = $request->input('origins', ['New York, NY']);
        $destinations = $request->input('destinations', ['San Francisco, CA']);
        
        $distances = $this->googleDistanceMatrix->getDistanceMatrix($origins, $destinations);

        return response()->json($distances);
    }
}
