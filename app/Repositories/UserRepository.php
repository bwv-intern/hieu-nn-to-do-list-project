<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface {

    // Create a new user
    public function create(array $data) {

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

    }

    public function findByEmail(string $email) {

        return User::where('email', $email)->first();

        $user = $this->userRepo->findByEmail($request->email);

        if (!$user) {
            return back()->withErrors(['email' => 'User not found!']);
        }
    }

}