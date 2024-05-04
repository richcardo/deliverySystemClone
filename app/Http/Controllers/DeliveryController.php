<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreDeliveryRequest;
use App\Models\Delivery;
use App\Models\Rider;

class DeliveryController extends Controller
{
    public function index()
    {
        return view('deliveries.index', [
            'deliveries' => Delivery::all(),
        ]);
    }

    public function create()
    {
        return view('deliveries.create', [
            'riders' => Rider::all(), 
        ]);
    }

    public function store(StoreDeliveryRequest $request)
    {
        $delivery = Delivery::create($request->all());
        return redirect()->back()->with(['success'=>'Consegna creata correttamente']);

    }
}
