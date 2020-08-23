<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
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
    protected $redirectTo = '/todo';

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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }
    /*dd($data);
      array:5 [▼
      "_token" => "3UfoHgYlctokVioOBLLZ5phCcCww5BWFmfBtMjOG"
      "name" => "info8"
      "email" => "info8@gmail.com"
      "password" => "000000"
      "password_confirmation" => "000000"
      ]
      */

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
    /* 
    'name' => "info8",
    'email' => "info8@gmail.com",
    'password' => "000000"（ハッシュ化されている）
    */
    /*
    LaravelのHashファサードは保存するユーザーパスワードに対し、
    安全なBcryptとArgon2ハッシュを提供する。
    Hashファサードのmakeメソッドを呼び出し、パスワードをハッシュできます
    */
}
