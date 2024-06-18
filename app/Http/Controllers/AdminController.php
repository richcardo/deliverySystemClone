<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Pnlinh\GoogleDistance\Facades\GoogleDistance;
use App\Services\GoogleDistanceMatrixService;
use Google\Service\Docs\TableRowStyle;

class AdminController extends Controller
{
    public function index(){
        $users= User::all();
        return view('admin.index', compact('users'));
    }
    
    public function create()
    {
        return view('admin.create', ['user'=>'', 'title'=>'Crea Utente']);
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
