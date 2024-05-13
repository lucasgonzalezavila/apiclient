<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller{
    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $token = auth()->user()->createToken('API Token')->accessToken;
            // Regenera la sesión
            $request->session()->regenerate();

            // Redirige al usuario a la página de inicio
            return redirect()->route('home');
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
        ]);

        $response = Http::post('http://127.0.0.1:8001/api/register', [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
            'password_confirmation' => $validatedData['password_confirmation'],
        ]);

        if ($response->successful()) {
            $token = $response['token'];
            // Regenera la sesión
            $request->session()->regenerate();
            // Redirecciona al dashboard u otra página
            return redirect()->route('dashboard');
        } else {
            return back()->withErrors(['error' => 'Unauthorized']);
        }
    }
}
