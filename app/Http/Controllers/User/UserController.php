<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserController extends Controller
{
    /* 
    * User Registration page
    */

    public function userRegister()
    {
        return Inertia::render('Auth/Register'); 
    }

    /* 
    * User Registration Submition Code
    */
    public function userRegisterSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        
        try{
            DB::beginTransaction();
            User::create($request->all());
            \DB::commit();
            return redirect()->route('login');
        }catch(Exception $e){
            \DB::rollBack();
            return $e->getMessage();
        }
    }

    /* 
    * User login Page
    */
     
    public function userLogin()
    {
        return Inertia::render('Auth/Login'); 
    }

    public function userLoginSubmit(Request $request)
    {

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('Token Name')->plainTextToken;
            return redirect()->route('dashboard');
        }
        return redirect()->back()->withErrors(['message'=>'User email or password mismatch']);
    }

    /* 
    * User Logout (Session Destroy)
    */
     
    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

}
