<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface {

    public function create(array $data);

    public function findByEmail(string $email);

    // Check email for jQuery Remote
    public function checkEmail(string $email);
}