<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Tarif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Imports\TicketsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;



class TicketController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Auth::user()->tickets()->latest()->paginate(10);
        return view("admin.tickets.index",compact("datas"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tarifs = Auth::user()->tarifs()->get();
        return view("admin.tickets.create", compact('tarifs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tarif_id' => 'required|exists:tarifs,id',
            'fichier' => 'required|mimes:csv,txt|max:2048', // Validate file upload
        ]);

        Session::put('tarif_id', $request->tarif_id);

        $file = $request->file('fichier');
        $fileName = Str::random(10) . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs('public/files', $fileName); // Store in storage/app/public/files

        Excel::import(new TicketsImport, storage_path('app/' . $filePath));
        Storage::delete($filePath);

        return redirect()->route('ticket.index')->with('success', 'Tickets importés avec succès!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket  $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $Ticket
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $tarifs = Auth::user()->tarifs()->get();
        $data = Ticket::where("slug", $slug)->first();
        if($data){
            return view("admin.tickets.edit",compact("data","tarifs"));
        }else{
            return view('admin.404');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $data = Ticket::where('slug', $slug)->first();
        if(!$data){
            return view("admin.404");
        }
        $request->validate([
            'user' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'dure' => 'required|string|max:255',
            'etat_ticket' => 'required|string|max:255',
            'tarif_id' => 'required|exists:tarifs,id',
        ]);
        $data->update($request->all());
        return redirect()->route('ticket.index')->with('success', 'Ticket mis à jour avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $data = Ticket::where("slug", $slug)->first();

        if($data){
            $data->delete();
            return redirect()->route('ticket.index')->with('success', 'Ticket supprimé avec succès!');
        }else{
            return view('admin.404');
        }
    }

}