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

    public function createDeliveryForRider(Rider $rider)
    {
        return view('deliveries.createForRider', compact('rider'));
    }

    public function store(StoreDeliveryRequest $request)
    {
        $delivery = Delivery::create($request->all());
        $total=0;
        $rider = $delivery->rider;
        if($delivery->rider_id){
            foreach($rider->deliveries as $consegna){
                if(!$consegna->pos){
                    $total = $total + $consegna->price;
                }
                
            }
            $total= $total + (50 - $rider->fuel);
            $total = round($total, 2);
           // $rider->total = $total;
           $rider->update(['total'=> $total]);
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
        return redirect()->back()->with(['success'=>'Consegna creata correttamente']);

    }

    public function edit(Delivery $delivery, $condition, $rider)
    {
        $riders = Rider::all();
        return view('deliveries.edit', [
            'delivery'=> $delivery,
            'riders' =>$riders,
            'condition' => $condition, 
            'rider' => $rider,
        ]);
    }

    public function update2(StoreDeliveryRequest $request, Delivery $delivery)
    {
        $delivery->update(['pos' => $request->pos]);
        return redirect()->back()->with(['success'=>'Pos modificato']);
    }
    public function update(StoreDeliveryRequest $request, Delivery $delivery, $condition, $rider2)
    {
       //dd($request->all());
        if($delivery->rider_id){
            $rider1 = $delivery->rider;
            $updateTotal =  $rider1->total - $delivery->price;
            $updateTotal=round($updateTotal,2);
            $rider1->update([
                'total'=> $updateTotal,
            ]);
           // dd($rider1);

        }
        
        //dd($rider1);

        $delivery->update($request->all());

        $total=0;
       // $rider = $delivery->rider;
       $rider = Rider::find($delivery->rider_id);

       if($delivery->rider_id){
            //dd($rider->deliveries);
            foreach($rider->deliveries as $consegna){
                    if(!$consegna->pos){
                        $total = $total + $consegna->price;
                    }
                }
                $total= $total + (50 - $rider->fuel);
                $total = round($total, 2);

            $rider->update(['total'=> $total]);
       }
        if($condition=='delivery'){
            return redirect()->route('delivery.index')->with(['success'=> 'Consegna modificata correttamente']);
        }
        else if($condition=='rider')
        {
            if($rider2==0){
                return redirect()->route('riders.index')->with(['success'=> 'Consegna modificata correttamente']);
            }
            else {
                return redirect()->route('rider.profile', $rider)->with(['success'=> 'Consegna modificata correttamente']);
            }
            
        }
  
        
    }

    public function destroy(Delivery $delivery)
    {
        $rider= $delivery->rider;
        $delivery->delete();

        $total=0;
        $rider = $delivery->rider;
        if($rider->deliveries){
            foreach($rider->deliveries as $consegna){
                if(!$consegna->pos){
                    $total = $total + $consegna->price;
                }
            }
            $total= $total + (50 - $rider->fuel);
            $total = round($total, 2);
           $rider->update(['total'=> $total]);
        }

        

        return redirect()->back()->with(['success'=>'Consegna Eliminata correttamente!']);

    }

    public function search()
    {
        return view('deliveries.search');
    }
}
