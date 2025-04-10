<?php

namespace App\Http\Controllers;

use App\Models\AProposDeMoi;
use App\Models\Competences;
use App\Models\Formations;
use App\Models\Projets;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class GestionController extends Controller
{
    /** Retourne le dashboard admin
     * @return [type]
     */
    function indexDashboard()
    {
        return view('adminDashBoard.index');
    }

    function indexSecureDashboard()
    {
        return view('adminSecureDashBoard.index');
    }

    function indexCV()
    {
        return view('cv.index');
    }

    function indexVeille()
    {
        return view('veille.index');
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
        $competence = Competences::selectRaw("
            competences.*
            ")
            ->get();
        return $competence;
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
            if ($request->method() == 'PUT') {
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
            if ($request->method() == 'POST') {
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
            if ($request->method() == 'PUT') {
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

    /** Sauvegarder les données de Projets
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
            if ($request->method() == 'POST') {
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
            if ($request->method() == 'PUT') {
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

    public function saveCompetence(Request $request)
    {
        $competence = $request->data;

        $result = [
            'statut' => 'ok',
            'message' => 'La compétence a bien été mise à jour.'
        ];

        if (!empty($competence)) {
            try {
                DB::beginTransaction();

                // Laravel va automatiquement caster en array PostgreSQL grâce au cast du modèle
                Competences::where('id', $competence['id'])->update(
                    Arr::except($competence, ['show_description'])
                );

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                $result = [
                    'statut' => 'ko',
                    'message' => 'Erreur lors de la mise à jour : ' . $e->getMessage()
                ];
            }
        } else {
            $result = [
                'statut' => 'ko',
                'message' => 'Aucune donnée reçue.'
            ];
        }

        return $result;
    }

    public function checkLogin(Request $request)
    {
        // Validation des données envoyées par la requête
        $request->validate([
            'id_admin' => 'required|integer',
            'name_admin' => 'required|string',
            'mdp_admin' => 'required|string',
        ]);
    
        // Récupérer l'administrateur avec les informations envoyées
        $admin = DB::table('secure_dashboard')
            ->where('id_admin', $request->id_admin)
            ->where('name_admin', $request->name_admin)
            ->first();
    
        // Vérifier si l'administrateur existe et si le mot de passe est correct
        if ($admin && Hash::check($request->mdp_admin, $admin->mdp_admin)) {
            // Si l'authentification est correcte, enregistrer l'administrateur dans la session
            session(['admin_id' => $admin->id_admin]);
    
            // Retourner une réponse de succès
            return response()->json(['success' => true]);
        }
    
        // Si les identifiants sont incorrects
        return response()->json(['success' => false], 401);
    }

    public function logout()
    {
        session()->forget('admin_id');
        return redirect('/securedashboard');
    }
    
}
