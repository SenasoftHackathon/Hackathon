<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Sucursal;
use App\Rol;

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
    protected $redirectTo = '/home';

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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
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
            'idSucursal' => $data['sucursal'],
            'idRol' => $data['rol'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function index(Request $request)
    {
        //
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        if ($buscar == "") {
            $users = User::join('sucursales', 'users.idSucursal', '=', 'sucursales.id')
                ->join('roles', 'users.idRol', '=', 'roles.id')
                ->select('users.id', 'users.name', 'users.email', 'users.idSucursal',  'users.idRol',  'users.estado', 'sucursales.nombre', 'roles.nombreRol')
                ->orderBy('users.id', 'desc')
                ->paginate(10);
        } else {
            $users = User::join('sucursales', 'users.idSucursal', '=', 'sucursales.id')
                ->join('roles', 'users.idRol', '=', 'roles.id')
                ->select('users.id', 'users.name', 'users.email', 'users.idSucursal',  'users.idRol',  'users.estado', 'sucursales.nombre', 'roles.nombreRol')
                ->where($criterio, 'like', '%' . $buscar . '%')
                ->orderBy('users.id', 'desc')
                ->paginate(10);
        }
        return [
            'pagination' => [
                'total'        => $users->total(),
                'current_page' => $users->currentPage(),
                'per_page'     => $users->perPage(),
                'last_page'    => $users->lastPage(),
                'from'         => $users->firstItem(),
                'to'           => $users->lastItem(),
            ],
            'users' => $users
        ];
    }

    public function store(Request $request)
    {
        //
        $user = new User();
        $user->idSucursal = $request->idSucursal;
        $user->idRol = $request->idRol;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->estado = '1';
        $user->save();
    }
    
    public function selectSucursal()
    {
        $sucursales = Sucursal::select('id', 'nombre')->orderBy('nombre', 'asc')->get();
        return $sucursales;
    }
    public function selectRol()
    {
        $roles = Rol::select('id', 'nombreRol')->orderBy('nombre', 'asc')->get();
        return $roles;
    }
}
