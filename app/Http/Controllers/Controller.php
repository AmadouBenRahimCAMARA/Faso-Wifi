<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;
use App\Models\Tarif;
use App\Models\Wifi;
use App\Models\Ticket;
use App\Models\Paiement;
use App\Models\Solde;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;



class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    public function acheter($slug){

        $wifi = Wifi::where('slug',$slug)->first();
        $tarifs = [];
        if($wifi){
            //dd($wifi->tarifs);
            $tarifs = $wifi->tarifs()->get();
        }else{
        }
        return view('achat-ticket', compact('tarifs'));

    }

    public function apiPaiement(Request $request){

        $tarif = Tarif::find($request->tarif_id);

        //dd($tarif);

        return view('paiement.payin',compact('tarif'));
    }

    public function statutPaiement(Request $request){

        //$tarif = Tarif::find($request->tarif_id);

        //dd($tarif);

        return view('paiement.status');
    }

    public function recuperationView(){
        return view('mon-ticket');
    }

    public function recuperationPost(Request $request){

        $paiement = Paiement::where("transaction_id", $request->monTicket)->first();
        if($paiement){
            return redirect()->route("recu",$paiement->ticket->slug);
        }else{
            return view('mon-ticket-error');
        }
    }

    public function recu($slug)
    {
        //dd(Paiement::all());
        $paiement = [];
        $datas = [];
        $data = Ticket::where("slug", $slug)->first();

        if($data){
            if($data->etat_ticket === "VENDU"){
                $paiement = Paiement::where("ticket_id",$data->id)->first();
            }else{
                session_start();
                $from_data = unserialize($_SESSION['paiement']);
                $from_data['user_id'] = $data->user_id;


                //dd($_SESSION['first_time']);
                $paiement = Paiement::create($from_data);
               // $ticket = App\Models\Ticket::find($ticket_id);
                $data->etat_ticket = "VENDU";
                //$ticket->vente_date = lluminate\Support\Carbon::now();
                $data->save();

                $solde = Solde::where('user_id', $paiement->user_id)->orderBy('id', 'desc')->first();
                $montantCompte = 0;
                if($solde){
                    $montantCompte = $solde->solde;
                }

                Solde::create([
                    "solde" => $montantCompte + $data->tarif->montant,
                    "type" => "PAIEMENT",
                    "slug" => Str::slug(Str::random(10)),
                    "user_id" => $data->user_id,
                    "paiement_id" => $paiement->id
                ]);
            }


            //$paiement = Paiement::where("ticket_id",$data->id)->first();
            //dd($paiement);
        }

        return view("paiement.recu",compact("datas","data","paiement"));
    }

    public function downloadRecu($slug)
    {
        //dd(Paiement::all());
        $paiement = [];
        $datas = [];
        $data = Ticket::where("slug", $slug)->first();
        if($data){
            //dd($data);
            $paiement = Paiement::where("ticket_id",$data->id)->first();
            //dd($paiement);
        }

        $pdf = Pdf::loadView('paiement.recu-v1', compact("datas","data","paiement"));
        return $pdf->download('TICKET-FASOWIFI-' . date('dmYHis') . '.pdf');
    }

    public function viewNumber($number){

        session()->put('view', $number);

        return "ok";
    }
}
