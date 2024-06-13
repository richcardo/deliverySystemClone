<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Pnlinh\GoogleDistance\Facades\GoogleDistance;
use App\Services\GoogleDistanceMatrixService;
use Google\Service\Docs\TableRowStyle;

class AdminController extends Controller
{

    protected $googleDistanceMatrix;

    public function __construct(GoogleDistanceMatrixService $googleDistanceMatrix)
    {
        $this->googleDistanceMatrix = $googleDistanceMatrix;
    }
    public function index(){
        $users= User::all();
        return view('admin.index', compact('users'));
    }
    
    public function create()
    {
        $distances = $this->googleDistanceMatrix->getDistanceMatrix(['Via Randaccio 18 Cagliari'], ['Via AntonioFais 14 Cagliari']);
        dd(($distances['rows'][0]['elements'][0]['distance']['value'])/1000);
        return view('admin.create');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with(['success'=>'Utente Eliminato']);
    }

    public function calcuatedistances()
    {
        
    }


}
