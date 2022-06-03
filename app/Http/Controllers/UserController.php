<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    // // API
    
    // public function register(Request $request)
    // {
    //     $this->validate($request, [
    //         'name' => 'required|min:4',
    //         'email' => 'required|email',
    //         'password' => 'required|min:8',
    //     ]);
 
    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => bcrypt($request->password)
    //     ]);
       
    //     $token = $user->createToken('LaravelAuthApp')->accessToken;
 
    //     return response()->json(['token' => $token], 200);
    // }
 
    // /**
    //  * Login
    //  */
    // public function login(Request $request)
    // {
    //     $login = $request->validate([
    //         'email' => 'required',
    //         'password'=> 'required',
    //     ]);
    //     if (!Auth::attempt($login)){
    //         return response()->json(['message' => 'error']);
    //     }
    //     /** @var \App\Models\User $user **/
    //     $user = Auth::user();
    //     $token = $user->createToken('MyToken')->accessToken;
    //     return response()->json(['user' => $user, 'token' => $token]);
    // }   
}
