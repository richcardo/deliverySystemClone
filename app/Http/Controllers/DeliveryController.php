<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreDeliveryRequest;
use App\Models\Delivery;
use App\Models\Rider;
use App\Services\GoogleDistanceMatrixService;

class DeliveryController extends Controller
{
    protected $googleDistanceMatrix;

    public function __construct(GoogleDistanceMatrixService $googleDistanceMatrix)
    {
        $this->googleDistanceMatrix = $googleDistanceMatrix;
    }

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

    public function createDeliveryForRider(Rider $rider)
    {
        return view('deliveries.createForRider', compact('rider'));
    }

    public function store(StoreDeliveryRequest $request, $condition)
    {
        $delivery = Delivery::create($request->all());
        $origins = $request->origin;
        $destination = $request->address;

        $distances = $this->googleDistanceMatrix->getDistanceMatrix([$origins], [$destination]);
        //dd(($distances['rows'][0]['elements'][0]['distance']['value']/1000));

        $delivery->distance = ($distances['rows'][0]['elements'][0]['distance']['value'] / 1000);
        $delivery->save();
        //Calcolo del totale delle consegne in prezzo
        $total = 0;
        $rider = $delivery->rider;
        if ($delivery->rider_id) {
            foreach ($rider->deliveries as $consegna) {
                if (!$consegna->pos) {
                    $total = $total + $consegna->price;
                }

            }
            $total = $total + (50 - $rider->fuel);
            $total = round($total, 2);
            // $rider->total = $total;
            $rider->update(['total' => $total]);
        }

        //Calcolo del totale della distanza percorsa

        if ($delivery->id) {
            if ($delivery->rider) {
                $rider = $delivery->rider;
                $totalDistance = 0;
                foreach ($rider->deliveries as $delivery) {
                    $totalDistance += $delivery->distance;
                }
                $rider->total_distance = $totalDistance;
                $rider->save();
            }

        }

        /*
        if($delivery->rider_id){
                $rider = $delivery->rider;
            foreach($rider->deliveries as $delivery){
                if(!$delivery->pos){
                    $total=$total + $delivery->price;
                }
            }
            $rider->total = $total + (50-$rider->fuel);
        }
        */
        if ($condition == 'riders') {
            return redirect()->route('riders.index')->with(['success' => 'Consegna creata correttamente']);
        } else {
            return redirect()->route('delivery.index')->with(['success' => 'Consegna creata correttamente']);
        }


    }

    public function edit(Delivery $delivery, $condition, $rider)
    {
        $riders = Rider::all();
        return view('deliveries.edit', [
            'delivery' => $delivery,
            'riders' => $riders,
            'condition' => $condition,
            'rider' => $rider,
        ]);
    }

    public function update2(StoreDeliveryRequest $request, Delivery $delivery)
    {
        $delivery->update(['pos' => $request->pos]);

        return redirect()->back()->with(['success' => 'Pos modificato']);
    }
    public function update(StoreDeliveryRequest $request, Delivery $delivery, $condition, $rider2)
    {
        //dd($request->all());
        //Scalo i soldi della consegna che sto modificando
        if ($delivery->rider_id) {
            $rider1 = $delivery->rider;
            $updateTotal = $rider1->total - $delivery->price;
            $updateTotal = round($updateTotal, 2);
            $rider1->update([
                'total' => $updateTotal,
            ]);
            // dd($rider1);

        }
        //scalo la distanza della consegna che sto modificando 
        if ($delivery->rider_id) {
            $rider = $delivery->rider;
            $distance_to_delete = $delivery->distance;
            $rider->total_distance = $rider->total_distance - $distance_to_delete;
            $rider->save();
        }

        //dd($rider1);

        $delivery->update($request->all());
        //calcolo la distanza e la assegno alla consegna dopo di che ricalcolo il totale della distanza percorsa dal rider
        $origins = $request->origin;
        $destination = $request->address;
        $distances = $this->googleDistanceMatrix->getDistanceMatrix([$origins], [$destination]);
        $delivery->distance = ($distances['rows'][0]['elements'][0]['distance']['value'] / 1000);
        $delivery->save();
        //ricalcolo il totale della distanza percorsa dal rider
        if ($delivery->id) {
            $rider = $delivery->rider;
            $totalDistance = 0;
            if ($rider->deliveries) {
                foreach ($rider->deliveries as $delivery) {
                    $totalDistance += $delivery->distance;
                }
            }

            $rider->total_distance = $totalDistance;
            $rider->save();
        }


        //ricalcolo il totale dopo aver modificato la consegna e quindi il prezzo eventualmente
        $total = 0;
        // $rider = $delivery->rider;
        $rider = Rider::find($delivery->rider_id);

        if ($delivery->rider_id) {
            //dd($rider->deliveries);
            foreach ($rider->deliveries as $consegna) {
                if (!$consegna->pos) {
                    $total = $total + $consegna->price;
                }
            }
            $total = $total + (50 - $rider->fuel);
            $total = round($total, 2);

            $rider->update(['total' => $total]);
        }
        if ($condition == 'delivery') {
            return redirect()->route('delivery.index')->with(['success' => 'Consegna modificata correttamente']);
        } else if ($condition == 'rider') {
            if ($rider2 == 0) {
                return redirect()->route('riders.index')->with(['success' => 'Consegna modificata correttamente']);
            } else {
                return redirect()->route('rider.profile', $rider)->with(['success' => 'Consegna modificata correttamente']);
            }

        }


    }

    public function destroy(Delivery $delivery)
    {
        $rider = $delivery->rider;
        $delivery->delete();
        //Ricaclolo del totale dopo aver eliminato una consegna
        $total = 0;
        if ($delivery->rider) {
            $rider = $delivery->rider;
            if ($rider->deliveries) {
                foreach ($rider->deliveries as $consegna) {
                    if (!$consegna->pos) {
                        $total = $total + $consegna->price;
                    }
                }
                $total = $total + (50 - $rider->fuel);
                $total = round($total, 2);
                $rider->update(['total' => $total]);
            }
        }


        //ricalcolo la distanza total del rider
        if ($rider) {
            $totalDistance = 0;
            if ($rider->deliveries) {

                foreach ($rider->deliveries as $delivery) {
                    $totalDistance += $delivery->distance;
                }
            }

            $rider->total_distance = $totalDistance;
            $rider->save();
        }



        return redirect()->back()->with(['success' => 'Consegna Eliminata correttamente!']);

    }

    public function destroyAll()
    {

        $deliveries = Delivery::all();

        if ($deliveries) {
            foreach ($deliveries as $delivery) {
                $delivery->delete();
            }

            $riders = Rider::all();

            foreach ($riders as $rider) {
                $total = 50 - $rider->fuel;
                $rider->total = $total;
                $rider->total_distance = 0;
                $rider->save();
            }

            return redirect()->back()->with(['success' => 'Consegne Eliminate Correttamente']);
        }

        return redirect()->back()->with(['success' => 'Non ci sono consegne da eliminare']);
    }
}
