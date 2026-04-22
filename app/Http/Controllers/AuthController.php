<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Repositories\Interfaces\UserRepositoryInterface;
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

    public function login(LoginRequest $request) {
        if (Auth::attempt($request->validated())) {

            $request->session()->regenerate();
            
            return redirect()->intended('dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }
}

