<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
  public function register(Request $request) {

    $this->validate($request, [
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'password' => 'required|string|min:6'
    ]);

    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = bcrypt($request->password);

    $user->save();



    return ['message' => 'Usuário criado!', 'user' => $user];

  }

  public function login(Request $request) {

    $this->validate($request, [
      'email' => 'required|string|email',
      'password' => 'required|string|min:6'
    ]);


    $credential = $request->only('email', 'password');

    if (!$token = JWTAuth::attempt($credential)) {
      return 'Não autenticado!';
    }


    return ['token' => $token];
  }
}
