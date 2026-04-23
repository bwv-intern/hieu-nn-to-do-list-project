<?php

namespace App\Observers;

use App\Models\Category;

class CategoryObserver
{

    public function creating(Category $category): void
    {
        // Automatically assign the authenticated user's ID before saving to the database
        if (auth()->check()) {
            $category->user_id = auth()->id();
        }
        
        // Generate a unique slug based on the category name before saving
        $category->generateSlug($category->name);   
    }

    /**
     * Handle the Category "created" event.
     */
    public function created(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "updated" event.
     */
    public function updated(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "deleted" event.
     */
    public function deleted(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "restored" event.
     */
    public function restored(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "force deleted" event.
     */
    public function forceDeleted(Category $category): void
    {
        //
    }
}
