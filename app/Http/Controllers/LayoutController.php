<?php

namespace App\Http\Controllers;

use App\Models\AProposDeMoi;
use App\Models\Competences;
use App\Models\Formations;
use App\Models\Projets;
use App\Models\User;
use Illuminate\Http\Request;

class LayoutController extends Controller
{
    public function home(){

        $propos = AProposDeMoi::get();
        $formations = Formations::get();

        return view('layouts.home', ['propos'=>$propos, 'formations'=>$formations]);

    }

    public function portfolio(){


        return view('layouts.portfolio');

    }

    function indexProjet($id){
        $exist = Projets::where('id', $id)->exists();
        if($exist){

            $projet = Projets::
            selectRaw('projets.*')
            ->where('projets.id', $id)
            ->get()
            ->first();
            return view('layouts.indexProjet', ["projet" => $projet]);


        }else{
            return view('notFound');
        }
    }

    function indexCompetence($id){
        $exist = Competences::where('id', $id)->exists();
        if($exist){

            $competence = Competences::
            selectRaw('competences.*')
            ->where('competences.id', $id)
            ->get()
            ->first();
            return view('layouts.indexCompetence', ["competence" => $competence]);


        }else{
            return view('notFound');
        }
    }
}
