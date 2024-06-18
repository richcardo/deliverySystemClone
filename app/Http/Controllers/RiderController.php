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
        return view('riders.count', [
            'rider' => $rider,
            'pos'=> $total_pos,
        ]);
    }

    public function research(Request $request)
    {
        return Rider::search($request->input('searched'));
    }
}
