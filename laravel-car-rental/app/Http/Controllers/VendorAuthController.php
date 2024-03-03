<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\Vendor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class VendorAuthController extends Controller
{
    public function login()
    {


        return view('auth.vendors.login');
    }
    public function register()
    {
        return view('auth.vendors.register');
    }



    public function handleRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:agencies,email',
            'password' => 'required|min:4'
        ], [
            'name.required' => 'Agencies name is required',
            'email.required' => 'Email is required',
            'email.unique' => 'Email already taken',
            'password.required' => 'Password is required',
            'password.min' => 'password must have 4 caractères'
        ]);

        try {

            Agency::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            return redirect()->back()->with('success', 'Your agencie account has been created. Logged in to manage your cars now');
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function handleLogin(Request $request)
    {

        $request->validate([

            'email' => 'required|exists:agencies,email',
            'password' => 'required|min:4'
        ], [

            'email.required' => 'Adresse email requise',
            'email.exists' => 'Cette adresse email n\'est pas reconnu',
            'password.required' => 'Le mot de passe est requis',
            'password.min' => 'Le mot de passe doit avoir au moins 4 caractères'
        ]);

        try {



            if (auth('vendor')->attempt($request->only('email', 'password'))) {
                return redirect('/vendors/dashboard');
            } else {
                return redirect()->back()->with('error', 'Information de connexion de compte boutique non reconnu');
            }
        } catch (Exception $e) {
        }
    }
}
