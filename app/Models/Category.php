<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function categoryType()
    {
        return $this->belongsTo(CategoryType::class, 'category_type_id');
    }

    /**
     * Get the tour packages for the category.
     */
    public function tourPackages()
    {
        return $this->hasMany(TourPackage::class);
    }
}
