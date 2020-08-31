<?php

namespace App\Http\Controllers;

use App\Risk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RisksController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('risks.index', [
            'title' => 'Ryzyka ubezpieczeniowe',
            'risks' => Risk::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Risk::class);
        
        return view('risks.create', [
            'title' => 'Nowe ryzyko ubezpieczeniowe',
            'description' => 'Uzupełnij dane ryzyka i kliknij Zapisz',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Risk::class);
        
        $risk = new Risk($request->all());
        Auth::user()->risks()->save($risk);

        return redirect()->route('risks.show', $risk->id)->with('notify_success', 'Nowe ryzyko ubezpieczeniowe zostało dodane!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Risk  $risk
     * @return \Illuminate\Http\Response
     */
    public function edit(Risk $risk)
    {
        $this->authorize('update', $risk);

        return view('risks.edit', [
            'title' => 'Edycja ryzyka ubezpieczeniowego',
            'description' => 'Zaktualizuj dane ryzyka i kliknij Zapisz',
            'risk' => $risk,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Risk  $risk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Risk $risk)
    {
        $this->authorize('update', $risk);
        $risk->update($request->all());

        return redirect()->route('risks.show', $risk->id)->with('notify_success', 'Dane ryzyka ubezpieczeniowego zostały zaktualizowane!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Risk  $risk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Risk $risk)
    {
        $this->authorize('delete', $risk);
        $risk->delete();

        return redirect()->route('risks.index')->with('notify_danger', 'Ryzyko ubezpieczeniowe zostało usunięte!');
    }
}
