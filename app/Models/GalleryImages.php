<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryImages extends Model
{
    use HasFactory;

    protected $fillable = [
        'tour_package_id',
        'image_path',
        'caption',
        'sort_order',
    ];

    public function tourPackage()
    {
        return $this->belongsTo(TourPackage::class);
    }
}
