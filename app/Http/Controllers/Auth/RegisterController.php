<?php

namespace App\Http\Controllers\Auth;

use App\Trainer;
use App\User;
use App\Http\Controllers\Controller;
use App\Utils\CommonUtil;
use App\Utils\EmailUtil;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected $city = null;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        error_log('validator: ');
        error_log(print_r($data,true)); //array log




        $rules = null;

        if($data['role'] == 'user') {
            $rules = array(
                'name' => 'required|string|max:255',
                'surname' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
                'role' => 'required',
            );


        } else if($data['role'] == 'trainer') {
            $this->city = CommonUtil::checkIfCityIsValid($data['city']);
            error_log('city: '.$this->city);
            if(!isset($this->city)) {
                $data['city'] = '';
            }
            $rules = array(
                'name' => 'required|string|max:255',
                'surname' => 'required|string|max:255',
                'city' => 'required|string|max:25',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
                'role' => 'required',
                'phone' => 'required|regex:/^[0-9]{9}$/'
            );
        }

        $messages = [
            'phone.regex' => 'Podano niepoprawny format telefonu'
        ];
        return  \Illuminate\Support\Facades\Validator::make($data, $rules, $messages );

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $role = \App\Role::where('name',$data['role'])->first();
        error_log('role: '.$data['role']);
        $user = null;

        if($data['role'] == 'trainer') {
            $user = User::create([
                'login'=> $data['email'],
                'name' => $data['name'],
                'surname' => $data['surname'],
                'email' => $data['email'],
                'city' => $data['city'],
                'sex' => $data['sex'],
                'password' => Hash::make($data['password']),
            ]);
            $trainer = Trainer::create([
                'email' => $data['email'],
                'name' => $data['name'],
                'surname' => $data['surname'],
                'city' => $this->city->name,
                'voivodeship' => $this->city->voivodeship,
                'phone' => $data['phone'],
                'sex' => $data['sex'],
                'user_id' => $user->id
            ]);
            $user->cities()->attach($this->city);
            $trainer->cities()->attach($this->city);
            $this->redirectTo = '/trainer-panel/profile-setup';
        } else if($data['role'] == 'user') {
            $user = User::create([
                'login'=> $data['email'],
                'name' => $data['name'],
                'surname' => $data['surname'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
            $this->redirectTo = '/search-trainer';
        }
        $user->roles()->attach($role);

        error_log('$user: '.$user);

        return $user;
    }
}
