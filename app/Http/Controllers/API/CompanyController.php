<?php

namespace App\Http\Controllers\API;

use App\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
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

            return Company::latest()->with('user')->paginate(10);
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
        return Company::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (\Gate::allows('isAdmin')) {
            $company = Company::with('user')->with('gyms')->with('trainers')->findOrFail($id);
            return $company;
        }
        return ['message' => 'Unauthorized access'];
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
            $company = Company::findOrFail($id);

            if(isset($request->picture)){
                $name = time().'.' . explode('/', explode(':', substr($request->picture, 0, strpos($request->picture, ';')))[1])[1];
                \Image::make($request->picture)->save(public_path('img/company/').$name);
                $request->merge(['picture' => $name]);
                $companyPicture = public_path('img/company/').$company->picture;
                if(file_exists($companyPicture)){
                    @unlink($companyPicture);
                }
            }

            $company->update($request->all());
            return ['message' => 'Updated the company info'];
        }

        return ['message' => 'Company can not be updated'];
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
            $company = Company::findOrFail($id);
            $company->delete();
            return ['message' => 'Company deleted'];

        }

        return ['message' => 'Company can not be deleted'];
    }

    public function search(){
        if ($search = \Request::get('q')) {
            $companies = Company::where(function($query) use ($search){
                $query->where('name','LIKE',"%$search%");
            })->with('user')->paginate(10);
        } else {
            $companies = Company::latest()->with('user')->paginate(10);
        }
        return $companies;
    }
}
