<?php

namespace App\Http\Controllers;

use App\Models\Tarif;
use Illuminate\Http\Request;

class PublicTarifController extends Controller
{
    /**
     * Display a listing of the public tariffs.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tarifs = Tarif::all(); // Fetch all tariffs
        return view('tarifs.index', compact('tarifs'));
    }
}