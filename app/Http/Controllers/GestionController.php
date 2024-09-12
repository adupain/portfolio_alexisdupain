<?php

namespace App\Http\Controllers;

use App\Models\AProposDeMoi;
use App\Models\Competences;
use App\Models\Formations;
use App\Models\Projets;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class GestionController extends Controller
{
    /** Retourne le dashboard admin
     * @return [type]
     */
    function indexDashboard()
    {
        return view('adminDashBoard.index');
    }

    /**
     * Recuperer les données de "Propos"
     * @return [type]
     */
    function getPropos()
    {
        $propos = AProposDeMoi::selectRaw("
            a_propos_de_moi.*,
            FALSE AS show_description
            ")
            ->get();

        return $propos;
    }

    /**
     * Recuperer les données de "Propos"
     * @return [type]
     */
    function getFormations()
    {
        $formations = Formations::selectRaw("
            formations.*,
            FALSE AS show_description
            ")
            ->get();

        return $formations;
    }

    function getProjets()
    {
        $projets = Projets::selectRaw("
            projets.*,
            FALSE AS show_description
            ")
            ->get();
        return $projets;
    }

    function getCompetences()
    {
        $competences = Competences::selectRaw("
            competences.*
            ")
            ->get();
        return $competences;
    }

    /** Sauvegarder les données de A propos de moi
     * @return [type]
     */
    public function savePropos(Request $request)
    {
        $propos = $request->data;
        $result = [
            'statut' => 'ok',
            'message' => 'Les données ont bien été sauvegardé'
        ];
        if (!empty($propos)) {
            if($request->method() == 'PUT'){
                try {
                    DB::beginTransaction();
                    AProposDeMoi::where('id', $propos['id'])->update(Arr::except($propos, ['show_description']));
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();
                    $result = [
                        'statut' => 'ko',
                        'message' => 'Sauvegarde impossible ' . $e->getMessage()
                    ];
                }
            }
        } else {
            $result = [
                'statut' => 'ko',
                'message' => 'Aucune donnée'
            ];
        }
        return $result;        
    }

    /** Sauvegarder les données de Formations
     * @return [type]
     */
    public function saveFormations(Request $request)
    {
        $formations = $request->data;
        $result = [
            'statut' => 'ok',
            'message' => 'Les données ont bien été sauvegardé'
        ];
        if (!empty($formations)) {
            $new_formation = null;
            if($request->method() == 'POST'){
                try {
                    DB::beginTransaction();
                    $new_formation = Formations::create(Arr::except($formations, ['show_description']));
                    DB::commit();
                    $result['formation_id'] = $new_formation->id;
                } catch (\Exception $e) {
                    DB::rollBack();
                    $result = [
                        'statut' => 'ko',
                        'message' => 'Sauvegarde impossible ' . $e->getMessage()
                    ];
                }
            }
            if($request->method() == 'PUT'){
                try {
                    DB::beginTransaction();
                    Formations::where('id', $formations['id'])->update(Arr::except($formations, ['show_description']));
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();
                    $result = [
                        'statut' => 'ko',
                        'message' => 'Sauvegarde impossible ' . $e->getMessage()
                    ];
                }
            }
        } else {
            $result = [
                'statut' => 'ko',
                'message' => 'Aucune donnée'
            ];
        }
        return $result;        
    }

    public function deleteFormations(Request $request)
    {
        $formation["id"] = $request->id;
        $result = [
            'statut' => 'ok',
            'message' => "La formation a bien été supprimé"
        ];
        if (!empty($formation)) {
            try {
                DB::beginTransaction();
                Formations::where('id', $formation['id'])->delete();
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                $result = [
                    'statut' => 'ko',
                    'message' => 'Suppression impossible ' . $e->getMessage()
                ];
            }
        } else {
            $result = [
                'statut' => 'ko',
                'message' => 'Aucune donnée'
            ];
        }
        return $result;
    }

    /** Sauvegarder les données de Formations
     * @return [type]
     */
    public function saveProjets(Request $request)
    {
        $projets = $request->data;
        $result = [
            'statut' => 'ok',
            'message' => 'Les données ont bien été sauvegardé'
        ];
        if (!empty($projets)) {
            $new_projet = null;
            if($request->method() == 'POST'){
                try {
                    DB::beginTransaction();
                    $new_projet = Projets::create(Arr::except($projets, ['show_description']));
                    DB::commit();
                    $result['projet_id'] = $new_projet->id;
                } catch (\Exception $e) {
                    DB::rollBack();
                    $result = [
                        'statut' => 'ko',
                        'message' => 'Sauvegarde impossible ' . $e->getMessage()
                    ];
                }
            }
            if($request->method() == 'PUT'){
                try {
                    DB::beginTransaction();
                    Projets::where('id', $projets['id'])->update(Arr::except($projets, ['show_description']));
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();
                    $result = [
                        'statut' => 'ko',
                        'message' => 'Sauvegarde impossible ' . $e->getMessage()
                    ];
                }
            }
        } else {
            $result = [
                'statut' => 'ko',
                'message' => 'Aucune donnée'
            ];
        }
        return $result;        
    }

    public function deleteProjets(Request $request)
    {
        $projet["id"] = $request->id;
        $result = [
            'statut' => 'ok',
            'message' => "Le projet a bien été supprimé"
        ];
        if (!empty($projet)) {
            try {
                DB::beginTransaction();
                Projets::where('id', $projet['id'])->delete();
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                $result = [
                    'statut' => 'ko',
                    'message' => 'Suppression impossible ' . $e->getMessage()
                ];
            }
        } else {
            $result = [
                'statut' => 'ko',
                'message' => 'Aucune donnée'
            ];
        }
        return $result;
    }
}