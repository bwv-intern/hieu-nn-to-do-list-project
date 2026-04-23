<?php

namespace App\Repositories\Interfaces;

interface CategoryRepositoryInterface {
    public function getAllForUser($userId);
    public function create(array $data);
    public function findBySlug($slug);
    public function delete($id);
}