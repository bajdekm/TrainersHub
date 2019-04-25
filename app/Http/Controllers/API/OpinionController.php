<?php

namespace App\Http\Controllers\API;

use App\Opinion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OpinionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('checkIfLogged');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Gate::allows('isAdmin')) {

            return Opinion::latest()->with('trainer')->with('user')->paginate(10);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Opinion::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (\Gate::allows('isAdmin')) {
            $opinion = Opinion::findOrFail($id);
            $opinion->update($request->all());
            return ['message' => 'Updated the opinion info'];
        }

        return ['message' => 'Opinion can not be updated'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (\Gate::allows('isAdmin')) {
            $this->authorize('isAdmin');
            $opinion = Opinion::findOrFail($id);
            $opinion->delete();
            return ['message' => 'Opinion deleted'];

        }

        return ['message' => 'Opinion can not be deleted'];
    }
}
