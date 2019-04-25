<?php

namespace App\Http\Controllers\API;

use App\Facility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FacilityController extends Controller
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

            return Facility::latest()->paginate(10);
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
        return Facility::create($request->all());
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
            $facility = Facility::findOrFail($id);
            $facility->update($request->all());
            return ['message' => 'Updated the facility info'];
        }

        return ['message' => 'Facility can not be updated'];
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
            $facility = Facility::findOrFail($id);
            $facility->delete();
            return ['message' => 'Facility deleted'];

        }

        return ['message' => 'Facility can not be deleted'];
    }

    public function search(){
        if ($search = \Request::get('q')) {
            $facility = Facility::where(function($query) use ($search){
                $query->where('name','LIKE',"%$search%");
            })->paginate(10);
        } else {
            $facility = Facility::latest()->paginate(10);
        }
        return $facility;
    }
}
