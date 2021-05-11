<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:10'],
            'last_name' => ['required', 'string', 'max:10'],
            'first_name_ruby' => ['required', 'string', 'max:10'],
            'last_name_ruby' => ['required', 'string', 'max:10'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role_id' => ['required', 'integer', 'exists:App\Models\Role,id'],
            'postal_code' => ['required', 'string', 'max:7'],
            'gender' => ['required', 'integer'],
            'birthday' => ['required', 'date'],
            'pref_id' => ['required', 'integer', 'exists:App\Models\Pref,id'],
            'city' => ['required', 'string', 'max:255'],
            'block' => ['required', 'string', 'max:255'],
            'building' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:15'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'first_name_ruby' => $data['first_name_ruby'],
            'last_name_ruby' => $data['last_name_ruby'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => $data['role_id'],
            'postal_code' => $data['postal_code'],
            'gender' => $data['gender'],
            'birthday' => $data['birthday'],
            'pref_id' => $data['pref_id'],
            'city' => $data['city'],
            'block' => $data['block'],
            'building' => $data['building'],
            'phone_number' => $data['phone_number'],

        ]);
    }
}
