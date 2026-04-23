<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface {
    
    /**
     * Get all categories belonging to a specific user
     */
    public function getAllForUser($userId) {
        return Category::where('user_id', $userId)->get();
    }

    /**
     * Create a new category
     * Only the name is required; Observer will handle slug and user_id automatically
     */
    public function create(array $data) {
        return Category::create($data);
    }

    /**
     * Find a category by its slug for the currently authenticated user
     * Throws 404 if not found
     */
    public function findBySlug($slug) {
        return Category::where('user_id', auth()->id())
            ->where('slug', $slug)
            ->firstOrFail();
    }

    /**
     * Delete a category by ID for the currently authenticated user
     * Ensures users can only delete their own categories
     */
    public function delete($id) {
        $category = Category::where('user_id', auth()->id())
            ->findOrFail($id);

        return $category->delete();
    }
}