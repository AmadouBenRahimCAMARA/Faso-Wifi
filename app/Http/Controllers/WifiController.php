<?php

namespace App\Http\Controllers;

use App\Models\Wifi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class WifiController extends Controller
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
        //dd(Auth::user()->wifis()->paginate(10));
        $datas = Auth::user()->wifis()->paginate(10);
        return view("admin.wifis.index",compact("datas"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.wifis.create");
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
            'nom' => 'required|string|max:255',
            'description' => 'required|string|max:1025',
        ]);
        $request['slug'] = Str::slug(Str::random(10));
        $request['user_id'] = Auth::user()->id;
        $wifi = Wifi::create($request->all());

        return redirect()->route('wifi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Wifi  $wifi
     * @return \Illuminate\Http\Response
     */
    public function show(Wifi $wifi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Wifi  $wifi
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $data = Wifi::where("slug", $slug)->get()->first();
        if($data){
            return view("admin.wifis.edit",compact("data"));
        }else{
            return view('admin.404');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Wifi  $wifi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $data = Wifi::where('slug', $slug)->first();
        if(!$data){
            return view("admin.404");
        }
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string|max:1025',
        ]);
        $data->update($request->all());
        return redirect()->route('wifi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wifi  $wifi
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $data = Wifi::where("slug", $slug)->first();
        if($data){
            $data->delete();
            return redirect()->route('wifi.index');
        }else{
            return view('admin.404');
        }
    }
}