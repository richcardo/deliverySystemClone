<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreRiderRequest;
use App\Models\Rider;

class RiderController extends Controller
{
    public function edit(Rider $rider)
    {
        return view('riders.edit', [
            'rider' => $rider,
        ]);
    }

    public function update(StoreRiderRequest $request, Rider $rider)
    {
        $rider->update($request->all());
        
        $total=0;
        foreach($rider->deliveries as $delivery){
            if(!$delivery->pos){
                $total = $total + $delivery->price;
            }
        }
        $total = $total + (50- $rider->fuel);
        $rider->update(['total'=>$total]);

        return redirect()->route('riders.index')->with(['success'=>'Rider modificato correttamente!']);
    }

    public function destroy(Rider $rider)
    {   
        foreach($rider->deliveries as $delivery){
            $delivery->delete();
        }
        
        $rider->delete();

        return redirect()->back()->with(['success'=>'Rider Eliminato con successo!']);
    }

    public function profile(Rider $rider)
    {

        $total=0;
        foreach($rider->deliveries as $delivery){

             if($delivery->pos == false ){
                $total= $total + $delivery->price;
             }

        }

        $total= $total + ( 50 - $rider->fuel);
           
        return view('riders.profile', [
            'rider' => $rider,
            'total' => $total,
        ]);
    }

    public function closeCount(Rider $rider)
    {
        $deliveries = $rider->deliveries;
        //dd($deliveries);
        $delivery_pos = $deliveries->where('pos', true);
        $total_pos = 0;
        foreach($delivery_pos as $delivery){
            $total_pos+=$delivery->price;
        }
        //metodo per calcolare la maggiore distanza ed il rider che l'ha percorsa
        /*Assegno la prima distanza come la maggiore e anche il primo rider come quello che ha percorso la maggior distanza
        $first_distance= Rider::all()->first()->total_distance;
        $riders = Rider::all();
        $rider_own_biggest_distance = Rider::all()->first();
        $biggest_distance = $first_distance;
        //confronto la distanza con le distanze percorse dagli altri rider
        foreach($riders as $rider1){
            if($rider1->total_distance>$biggest_distance){
                $biggest_distance = $rider1->total_distance;
                $rider_own_biggest_distance = $rider1;
            }
        }
        */
        //return
        //prova con desc->funziona
        $filter_rider = Rider::orderBy('total_distance','desc')->first();
        $distance_b = $filter_rider->total_distance;
        return view('riders.count', [
            'rider' => $rider,
            'pos'=> $total_pos,
            'filter_rider' => $filter_rider,
            'distance_b'=>$distance_b,

        ]);
    }

    public function research(Request $request)
    {
        return Rider::search($request->input('searched'));
    }
}
