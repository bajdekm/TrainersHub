<?php

namespace App\Http\Controllers\API;

use App\Trainer;
use App\User;
use App\Utils\CommonUtil;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getUserDetail()
    {

        $user = null;
        $userId = \Request::get('id');
        if (\Gate::allows('isUser')) {

            $user = User::with('company')
                ->with('gyms')
                ->with('roles')
                ->with('reservations.trainer')
                ->with('reservations.gym')
                ->with('trainer')
                ->findOrFail($userId);
        }

        return $user;
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
        $user = User::findOrFail($id);


        $this->validate($request,[
            'name' => 'required|string|max:191',
            'surname' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,'.$user->id
        ]);


        if( CommonUtil::checkUserEligibility($id) ){
            $user->update($request->all());
        }

        return ['message' => 'Updated the user profile'];
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        $id = $request['id'];
        $user = User::findOrFail($id);
        if(!empty($request['password'])){

            if( password_verify( $request['password'] , $user['password'] ) ){
                if( CommonUtil::checkUserEligibility($id) ){
                    $request->merge(['password' => Hash::make($request['newpassword'])]);
                    $user->update($request->all());
                }

            } else{
                return ['message' => 'Password does not match'];
            }

        }

        return ['message' => 'Updated the user password'];
    }

    private function disableUser( $user ){

        $trainer = Trainer::where('user_id',$user->id)->first();
        if(isset($trainer)) {
            $trainer->delete();
        }

        $user['name'] = 'Konto';
        $user['surname'] = 'Usuniete';
        $user['email'] = 'deleted@' . $user['id'] . ".com";
        $user->save();
    }

    public function checkPassword(Request $request)
    {
        $id = $request['id'];

        if( CommonUtil::checkUserEligibility( $id ) ){

            $user = User::findOrFail($id);
            if( password_verify( $request['password'] , $user['password'] ) ){
                $this->disableUser( $user );
                return ['message' => 'ok'];
            }
            else{
                return ['message' => 'ko'];
            }

        }
        else{
            return ['message' => 'ko'];
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
