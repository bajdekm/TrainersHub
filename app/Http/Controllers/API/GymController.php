<?php

namespace App\Http\Controllers\API;

use App\Gym;
use App\Http\Controllers\Utils\MapsUtil;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GymController extends Controller
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

            return Gym::latest()->with('company')->paginate(10);
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
        if(isset($request->company_id)) {
            $request->merge(['hasOwner' => 1]);
        } else {
            $request->merge(['hasOwner' => 0]);
        }

        $formAddress = $request['street'] . ' ' . $request['buildingNumber'] . ' ' . $request['city'] . ' ' . $request['country'];

        $address = MapsUtil::getGeocodeData( $formAddress , 'here');

        $request->merge(['fullAddress' => $address['faddress']]);
        $request->merge(['latitude' => $address['latitude']]);
        $request->merge(['longitude' => $address['longitude']]);
        $request->merge(['city' => $address['city']]);
        $request->merge(['postalCode' => $address['postalCode']]);
        $request->merge(['street' => $address['street']]);

        error_log('@@@ determined address ' . $address['faddress'] );


        return Gym::create($request->all());
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
            $gym = Gym::with('company')->with('facilities')->with('reservations')->findOrFail($id);
            return $gym;
        }
        return ['error' => 'Unauthorized access'];
    }
    public function detachFacility()
    {
        if (\Gate::allows('isAdmin')) {
            $facilityId = \Request::get('facilityId');
            $gymId = \Request::get('gymId');
            $gym = Gym::with('company')->with('facilities')->findOrFail($gymId);
            $gym->facilities()->detach($facilityId);
        } else {
            return ['error' => 'Unauthorized access'];
        }
    }
    public function attachFacility()
    {
        if (\Gate::allows('isAdmin')) {
            $facilityId = \Request::get('facilityId');
            $gymId = \Request::get('gymId');
            $gym = Gym::whereHas('facilities', function ($query) use ($facilityId) {
                $query->where('facilities.id', $facilityId);
            })->where('id', $gymId)
                ->get();
            if(count($gym)) {
                return ['message' => 'Facility already exist on this gym'];
            } else {
                error_log('## in else');
                $gymId = \Request::get('gymId');
                $gym = Gym::with('company')->with('facilities')->findOrFail($gymId);
                $gym->facilities()->attach($facilityId);
            }
        } else {
            return ['error' => 'Unauthorized access'];
        }
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
            $gym = Gym::findOrFail($id);

            if(isset($request->picture)){
                $name = time().'.' . explode('/', explode(':', substr($request->picture, 0, strpos($request->picture, ';')))[1])[1];
                \Image::make($request->picture)->save(public_path('img/gym/').$name);
                $request->merge(['picture' => $name]);
                $gymPicture = public_path('img/gym/').$gym->picture;
                if(file_exists($gymPicture)){
                    @unlink($gymPicture);
                }
            }

            $gym->update($request->all());
            return ['message' => 'Updated the Gym info'];
        }

        return ['message' => 'Gym can not be updated'];
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
            $gym = Gym::findOrFail($id);
            $gym->delete();
            return ['message' => 'Gym deleted'];

        }

        return ['message' => 'Gym can not be deleted'];
    }

    public function search(){
        if ($search = \Request::get('q')) {
            $gyms = Gym::where(function($query) use ($search){
                $query->where('name','LIKE',"%$search%");
            })->with('company')->paginate(10);
        } else {
            $gyms = Gym::latest()->with('company')->paginate(10);
        }
        return $gyms;
    }
}
