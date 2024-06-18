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


    
}
