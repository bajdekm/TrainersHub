<?php

namespace App\Http\Controllers\API;

use App\Discipline;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DisciplineController extends Controller
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
        if (\Gate::allows('isTrainerOrAdmin')) {

            return Discipline::latest()->with('trainers')->paginate(10);
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
        return Discipline::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Discipline::findOrFail($id);
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
        if (\Gate::allows('isTrainerOrAdmin')) {
            $discipline = Discipline::findOrFail($id);
            $discipline->update($request->all());
            return ['message' => 'Updated the discipline info'];
        }

        return ['message' => 'Discipline can not be updated'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (\Gate::allows('isTrainerOrAdmin')) {
            $this->authorize('isAdmin');
            $discipline = Discipline::findOrFail($id);
            $discipline->delete();
            return ['message' => 'Discipline deleted'];

        }

        return ['message' => 'Discipline can not be deleted'];
    }

    public function search(){
        if ($search = \Request::get('q')) {
            $discipline = Discipline::where(function($query) use ($search){
                $query->where('name','LIKE',"%$search%");
            })->paginate(10);
        } else {
            $discipline = Discipline::latest()->paginate(10);
        }
        return $discipline;
    }

    public function retrieveDisciplinesByCategory(){
        error_log('retrieveDisciplinesByCategory');
        if ($search = \Request::get('category')) {
            $discipline = Discipline::where(function($query) use ($search){
                $query->where('category','LIKE',"%$search%");
            })->paginate(100);
        } else {
            return null;
        }
        return $discipline;
    }

    public function retrievePaintballPricingDisciplines(){
        error_log('retrievePaintballPricingDisciplines');
        if (\Gate::allows('isTrainerOrAdmin')) {
            return Discipline::where('category','Paintball pricing')->paginate(10);
        }

        return ['message' => 'Discipline can not be retrieved'];
    }

}
