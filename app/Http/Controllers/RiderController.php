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

        return redirect()->back()->with(['success'=>'Rider modificato correttamente!']);
    }

    public function destroy(Rider $rider)
    {
        $rider->delete();

        return redirect()->back()->with(['success'=>'Rider Eliminato con successo!']);
    }
}
