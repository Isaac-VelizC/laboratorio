<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\listaCliente;
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
            'name' => ['required', 'string', 'max:255'],
            'apellido_pa' => ['required', 'string', 'max:255'],
            'apellido_ma' => ['nullable', 'string', 'max:255'],
            'ci' => ['required', 'string', 'max:255', 'unique:users'],
            'gender' => ['required', 'in:Masculino,Femenino'],
            'dob' => ['nullable', 'date'],
            'contact' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
            $user = User::create([
                'name' => $data['ci'],
                'nombres' => $data['name'],
                'apellido_pa' => $data['apellido_pa'],
                'apellido_ma' => $data['apellido_ma'],
                'ci' => $data['ci'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'type' => 3,
            ]);

            $user->assignRole('Cliente');
            // Creación del cliente asociado al usuario
            listaCliente::create([
                'gender' => $data['gender'],
                'dob' => $data['dob'],
                'contact' => $data['contact'],
                'address' => $data['address'],
                'user_id' => $user->id,
            ]);

            return $user;
    }

}
