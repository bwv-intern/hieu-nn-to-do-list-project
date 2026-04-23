<?php 

namespace App\Traits;

use Illuminate\Support\Str;

trait HasSlug {

    /**
     * Automatically generate a unique slug from a given value
     *
     * @param string $value  The value used to generate the slug (e.g. name/title)
     * @param string $field  (Optional) Field name - currently not used
     */
    public function generateSlug($value, $field = 'name')
    {
        // Generate the initial slug from the given value
        $slug = Str::slug($value);

        // Store the original slug for later use (in case of duplicates)
        $originalSlug = $slug;

        // Counter for duplicate handling
        $count = 1;

        // Check if the slug already exists in the database
        // If it does, append an incrementing number until it is unique
        while (static::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        // Assign the final unique slug to the model's attributes
        $this->attributes['slug'] = $slug;
    }
}