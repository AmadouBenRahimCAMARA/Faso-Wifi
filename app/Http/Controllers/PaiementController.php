<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Models\Ticket;
use App\Models\Solde;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class PaiementController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        //dd($request->view);
        $limit = session()->has('view') ? session()->get('view') : 10;
        $datas = Auth::user()->paiements()->latest()->paginate(10);
        return view("admin.paiement-liste",compact("datas","limit"));
    }

    /**
     * Show the withdrawal page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function retrait()
    {
        $solde = Solde::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->first();
        $montant = isset($solde) ? $solde->solde : 0;

        return view('paiement.retrait', compact('montant'));
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paiement  $paiement
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show(Paiement $paiement)
    {
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paiement  $paiement
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Paiement $paiement)
    {
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paiement  $paiement
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Paiement $paiement)
    {
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paiement  $paiement
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Paiement $paiement)
    {
        return back();
    }
}
