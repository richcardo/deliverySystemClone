<?php

namespace App\Http\Controllers;

use App\Models\Rider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PageController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }

    public function home()
    {
        return view('auth.home');
    }

    public function menu()
    {
        return view('riders.menu');
    }

    public function create()
    {
        return view('riders.create');
    }

    public function index()
    {
        return view('riders.index', [
            'users' => User::all(),
        ]
    );
    }

    public function statistics()
    {
        $riders= Rider::all();
        $rider = Rider::orderByDesc('total_distance')->first();
        $distance = $rider->total_distance;

        $most_deliveries = $rider->deliveries->count();
        $rider_most_deliveries = $rider->name;
        foreach($riders as $rider1){
            if($rider1->deliveries->count() > $most_deliveries){
                $most_deliveries = $rider1->deliveries->count();
                $rider_most_deliveries = $rider1->name;
            }
        }


        return view('statistic',[
            'rider' => $rider->name,
            'distance' => $distance,
            'rider_most_deliveries' => $rider_most_deliveries,
            'most_deliveries' => $most_deliveries,
        ]);
    }
    
}
