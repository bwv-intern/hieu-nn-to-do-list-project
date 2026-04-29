<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo) {
        $this->userRepo = $userRepo;
    }

    public function register(RegisterRequest $request) {

        $user = $this->userRepo->create($request->validated());

        return redirect()->route('login')
                         ->with('success', 'Account created!');
    }

    // Check email for jQuery Remote
    public function checkEmail(Request $request){
        $user = $this->userRepo->checkEmail($request->email);

        // Return true if don't find user's email in database. Email is available
        return response()->json($user ? false : true);
    }

    public function login(LoginRequest $request) {
        if (Auth::attempt($request->validated())) {

            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function showRegister() {
        return view('auth.register'); 
    }

    public function showLogin() {
        return view('auth.login');
    }

    public function logout(\Illuminate\Http\Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}

