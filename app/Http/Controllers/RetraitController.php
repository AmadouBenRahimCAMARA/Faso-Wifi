<?php

namespace App\Http\Controllers;

use App\Models\Retrait;
use App\Models\Paiement;
use App\Models\Ticket;
use App\Models\Solde;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RetraitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        {
            //dd($request->view);
            $limit = "";
            $datas = Auth::user()->retraits()->latest()->paginate(10);
            $user = Auth::user();

            $dateDuJour = Carbon::today(); // Récupère la date d'aujourd'hui

            //$retrait = Retrait::latest()->paginate(10);

            $ticketsDuJour = Ticket::whereDate('updated_at', $dateDuJour)
                            ->where([
                            'etat_ticket' => 'VENDU',
                            'user_id' => Auth::user()->id])
                            ->get();

            $ticketsTotalVendu = Ticket::where([
                            'etat_ticket' => 'VENDU',
                            'user_id' => Auth::user()->id])
                            ->get();


            //$solde = Solde::whereDate('updated_at', $dateDuJour)->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->first();
            $solde = Solde::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->first();
            $soldesDuJour = 0;
            foreach($ticketsDuJour as $ticket){
                $soldesDuJour = $soldesDuJour + $ticket->tarif->montant;
            }


            $montant = isset($solde) ? $solde->solde : 0;
            $compte = [
                "solde_total" => $montant,
                "retrait_total" => $montant - (25 * $montant)/100,
                "solde_du_jour" => $soldesDuJour,
                "ticket_du_jour_vendu" => count($ticketsDuJour),
                "ticket_total_vendu" => count($ticketsTotalVendu),
            ];

            return view("admin.retrait-liste",compact("datas","limit","user","compte"));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $dateDuJour = Carbon::today(); // Récupère la date d'aujourd'hui
        $solde = Solde::whereDate('updated_at', $dateDuJour)->orderBy('id', 'desc')->first();
        $montant = isset($solde) ? $solde->solde : 0;
        $retrait = $montant - (25 * $montant)/100;
        return view("admin.retrait-create", compact('retrait'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'montant_retrait' => 'required|numeric|min:1',
        ]);

        $user = Auth::user();
        $soldeActuel = Solde::where('user_id', $user->id)->orderBy('id', 'desc')->first();
        $montantActuel = $soldeActuel ? $soldeActuel->solde : 0;
        $montantARetirer = $request->input('montant_retrait');

        if ($montantARetirer > $montantActuel) {
            return back()->withErrors(['montant_retrait' => 'Le montant de retrait ne peut pas dépasser votre solde actuel.']);
        }

        try {
            DB::transaction(function () use ($user, $montantARetirer, $montantActuel) {
                // 1. Create the withdrawal record
                Retrait::create([
                    'user_id' => $user->id,
                    'montant' => $montantARetirer,
                    'statut' => 'en attente', // Set default status
                    'slug' => Str::slug(Str::random(10)),
                    // Add other necessary fields if the model requires them, like moyen_de_paiement, etc.
                    'moyen_de_paiement' => '-', // Placeholder
                    'numero_paiement' => '-' // Placeholder
                ]);

                // 2. Update the user's balance
                $nouveauSolde = $montantActuel - $montantARetirer;
                Solde::create([
                    'user_id' => $user->id,
                    'solde' => $nouveauSolde,
                ]);
            });

            return redirect()->route('paiement.retrait')->with('success', 'Votre demande de retrait a été soumise avec succès.');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Une erreur est survenue lors de la soumission de votre demande. Veuillez réessayer.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Retrait  $retrait
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show(Retrait $retrait)
    {
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Retrait  $retrait
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Retrait $retrait)
    {
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Retrait  $retrait
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Retrait $retrait)
    {
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Retrait  $retrait
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Retrait $retrait)
    {
        return back();
    }
}