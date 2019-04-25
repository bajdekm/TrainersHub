<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
        if (\Gate::allows('isAdmin') || \Gate::allows('isAuthor')) {
            return User::latest()->with('roles')->paginate(10);
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
        $this->validate($request,[
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:6'
        ]);

        return User::create([
            'login'=>$request['name'],
            'name' => $request['name'],
            'email' => $request['email'],
            'login' => $request['login'],
            'type' => $request['type'],
            'bio' => $request['bio'],
            'picture' => $request['picture'],
            'password' => Hash::make($request['password']),
        ]);
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
            $user = User::with('company')
                ->with('gyms')
                ->with('roles')
                ->with('reservations.trainer')
                ->with('reservations.gym')
                ->with('trainer')
                ->findOrFail($id);
            return $user;
        }
        return ['message' => 'Unauthorized access'];
    }

    public function profile()
    {
        return auth('api')->user();
    }
    public function roles()
    {

        $roles = Role::all('name','id');
        error_log('@@ ROLES: '.$roles);
        return $roles;
    }

    public function updateProfile(Request $request)
    {
        $user = auth('api')->user();

        $this->validate($request,[
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,'.$user->id,
            'password' => 'sometimes|required|min:6'
        ]);
        $this->savePicture($request,$user);

        if(!empty($request->password)){
            $request->merge(['password' => Hash::make($request['password'])]);
        }

        $user->update($request->all());
        return ['message' => "Success"];
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
            'email' => 'required|string|email|max:191|unique:users,email,'.$user->id
        ]);
        $this->savePicture($request,$user);
        $user->update($request->all());

        return ['message' => 'Updated the user info'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');
        $user = User::findOrFail($id);
        $user->delete();

        return ['message' => 'User deleted'];
    }

    public function search(){
        if ($search = \Request::get('q')) {
            $users = User::where(function($query) use ($search){
                $query->where('name','LIKE',"%$search%");
            })->with('roles')->paginate(10);
        } else {
            $users = User::latest()->with('roles')->paginate(10);
        }
        return $users;
    }

    public function detachRole(){
        if (\Gate::allows('isAdmin')) {
            $roleId = \Request::get('roleId');
            $userId = \Request::get('userId');
            $user = User::with('roles')->findOrFail($userId);
            $user->roles()->detach($roleId);
        } else {
            return ['error' => 'Unauthorized access'];
        }
    }

    public function attachRole()
    {
        if (\Gate::allows('isAdmin')) {
            $roleId = \Request::get('roleId');
            $userId = \Request::get('userId');
            $user = User::whereHas('roles', function ($query) use ($roleId) {
                $query->where('roles.id', $roleId);
            })->where('id', $userId)
                ->get();
            if(count($user)) {
                return ['message' => 'Role already exist on this gym'];
            } else {
                error_log('## in else');
                $user = User::with('roles')->findOrFail($userId);
                $user->roles()->attach($roleId);
            }
        } else {
            return ['error' => 'Unauthorized access'];
        }
    }

    private function savePicture($request,$user) {
        $currentPicture = $user->picture;
        if($request->picture != $currentPicture){
            $name = time().'.' . explode('/', explode(':', substr($request->picture, 0, strpos($request->picture, ';')))[1])[1];
            \Image::make($request->picture)->save(public_path('img/profile/').$name);
            $request->merge(['picture' => $name]);
            $userPicture = public_path('img/profile/').$currentPicture;
            if(file_exists($userPicture)){
                @unlink($userPicture);
            }
        }
    }
}
