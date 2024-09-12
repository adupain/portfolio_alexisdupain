<?php

namespace App\Http\Controllers;

use App\Models\AProposDeMoi;
use App\Models\Formations;
use App\Models\User;
use Illuminate\Http\Request;

class LayoutController extends Controller
{
    public function home(){

        $user = User::all();
        $propos = AProposDeMoi::get();
        $formations = Formations::get();

        return view('layouts.home', ['user'=>$user, 'propos'=>$propos, 'formations'=>$formations]);

    }

    public function portfolio(){

        $user = User::all();

        return view('layouts.portfolio', ['user'=>$user,]);

    }
}
