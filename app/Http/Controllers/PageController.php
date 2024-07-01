<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRiderRequest;
use App\Models\Delivery;
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


    public function create()
    {
        return view('riders.create2');
    }

    public function store(StoreRiderRequest $request)
    {
        //dd($request);
        $rider = Rider::create($request->all());
        $total = 50 - $rider->fuel;
        $rider->total = $total;
        $rider->total_distance = 0;
        $rider->save();

        return redirect()->route('riders.index')->with(['success' => 'Rider creato correttamente']);
    }
    public function index()
    {
        return view(
            'riders.index',
            [
                'users' => User::all(),
                'riders' => Rider::all(),
            ]
        );
    }

    public function statistics()
    {
        $riders = Rider::all();
        $rider = Rider::orderByDesc('total_distance')->first();
        $distance = $rider->total_distance;

        $most_deliveries = $rider->deliveries->count();
        $rider_most_deliveries = $rider->name;
        foreach ($riders as $rider1) {
            if ($rider1->deliveries->count() > $most_deliveries) {
                $most_deliveries = $rider1->deliveries->count();
                $rider_most_deliveries = $rider1->name;
            }
        }

        $total_cash = 0;
        foreach ($riders as $rider) {
            $deliveries = $rider->deliveries;
            foreach ($deliveries as $delivery) {
                $total_cash += $delivery->price;
            }
        }

        $total_deliveries = Delivery::count();

        return view('statistic', [
            'rider' => $rider->name,
            'distance' => $distance,
            'rider_most_deliveries' => $rider_most_deliveries,
            'most_deliveries' => $most_deliveries,
            'total_cash' => $total_cash,
        ]);
    }

}
