<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\GalleryImages;
use App\Models\TourPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    public function index(Request $request)
    {

        $rows = $request->input('rows');

        $albums = GalleryImages::orderby('created_at', 'desc')->paginate($rows ?? 10);
        $totalAlbums = GalleryImages::count();

        return view('backend.pages.gallery.index')->with('datas', $albums)
            ->with('totalAlbums', $totalAlbums);
    }

    public function create()
    {
        $category = Category::where('category_type_id', '2')
            ->where('status_id', '1')
            ->get();

        return view('backend.pages.gallery.create')->with('categories', $category);
    }

    public function edit($id)
    {
        $album = Album::find($id);
        $galleryImages = GalleryImages::where('album_id', $id)->get();
        $category = Category::where('category_type_id', '2')
            ->where('status_id', '1')
            ->get();
        return view('backend.pages.gallery.edit')->with('album', $album)->with('galleryImages', $galleryImages)->with('categories', $category);
    }

    public function store(Request $request)
    {
        $rules = [
            'tour_package_id' => 'required|exists:tour_packages,id',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Added max size
        ];

        $messages = [
            'tour_package_id.required' => 'The tour package ID is required.',
            'tour_package_id.exists' => 'The selected tour package does not exist.',
            'images.*.required' => 'Please select at least one image.',
            'images.*.image' => 'Gallery images must be image files.',
            'images.*.mimes' => 'Gallery images must be jpeg, png, jpg, or gif files.',
            'images.*.max' => 'Each gallery image must not exceed 2048 kilobytes.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        }

        $tourPackageId = $request->input('tour_package_id');
        $uploadedImages = $request->file('images');

        if (empty($uploadedImages)) {
            return response()->json(['success' => false, 'message' => 'No images were uploaded.']);
        }

        foreach ($uploadedImages as $uploadedImage) {
            $galleryImageFilename = hash('sha256', uniqid() . '_' . $uploadedImage->getClientOriginalName()) . '.' . $uploadedImage->getClientOriginalExtension();
            // Ensure the target directory exists and is writable.
            // For now, we assume 'public/uploads/album/' is correct and writable.
            // Consider making the upload path configurable or more specific to tour packages if needed.
            $uploadedImage->move(public_path('uploads/album/'), $galleryImageFilename);

            $galleryImageModel = new GalleryImages();
            $galleryImageModel->tour_package_id = $tourPackageId;
            // Assuming the model uses 'image' for the path, based on previous code.
            // The model actually uses 'image_path'. Let's use the correct field name.
            $galleryImageModel->image_path = $galleryImageFilename;
            // Add other fields if necessary, e.g., caption, sort_order
            // $galleryImageModel->caption = $request->input('caption'); // Example
            // $galleryImageModel->sort_order = $request->input('sort_order'); // Example
            $galleryImageModel->save();
        }

        return response()->json(['success' => true, 'message' => 'Gallery images uploaded successfully.']);
    }

    public function update(Request $request, $id)
    {
        // $validator = Validator::make($request->all(), [
        //     'title' => 'required',
        //     'slug' => 'required|unique:albums,slug,' . $id . '',
        // ], [
        //     'title.required' => 'The title field is required.',
        //     'slug.required' => 'The slug field is required.',
        //     'slug.unique' => 'The slug has already been taken.',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        // }

        // $tourPackage = TourPackage::findOrFail($id); // Assuming $id is tour_package_id

        // if ($request->albumImageStatus == 'deleted' && !empty($tourPackage->image)) { // Assuming tour package might have a cover image
        //     $filePath = public_path('uploads/tour_package_covers/' . $tourPackage->image); // Adjust path
        //     if (file_exists($filePath)) {
        //         File::delete($filePath);
        //     }
        //     $album->image = null;
        // }

        // if ($request->hasFile('cover')) {
        //     $coverValidator = Validator::make($request->all(), [
        //         'cover' => 'image|mimes:jpeg,png,jpg,gif|max:12048',
        //     ], [
        //         'cover.image' => 'The logo must be an image file.',
        //         'cover.mimes' => 'The logo must be a jpeg, png, jpg, or gif file.',
        //         'cover.max' => 'The logo file must not exceed 2048 kilobytes.',
        //     ]);

        //     if ($coverValidator->fails()) {
        //         return response()->json(['success' => false, 'message' => $coverValidator->errors()->first()]);
        //     }

        //     $cover = $request->file('cover');
        //     $coverFilename = hash('sha256', uniqid() . '_' . $cover->getClientOriginalName()) . '.' . $cover->getClientOriginalExtension();
        //     $cover->move(public_path('uploads/album/'), $coverFilename);
        //     $tourPackage->image = $coverFilename; // Assuming tour package might have a cover image
        // }

        // $tourPackage->title = $request->input('title'); // Adjust field names as per TourPackage model
        // $tourPackage->slug = Str::slug($request->input('slug'), '_');
        // $tourPackage->category_id = $request->input('category');
        // $tourPackage->status_id = $request->input('visibility');
        // $tourPackage->save();

        // if ($request->has('length')) {
        //     for ($i = 0; $i < $request->input('length'); $i++) {
        //         if ($request->has('image' . $i)) {
        //             if ($request->input('status' . $i) == 'newset') {
        //                 $galleryImage = $request->file('image' . $i);

        //                 if ($galleryImage->isValid()) {
        //                     $galleryImageFilename = hash('sha256', uniqid() . '_' . $galleryImage->getClientOriginalName()) . '.' . $galleryImage->getClientOriginalExtension();
        //                     $galleryImage->move(public_path('uploads/album/'), $galleryImageFilename);

        //                     $newGalleryImage = new GalleryImages();
        //                     $newGalleryImage->image = $galleryImageFilename;
        //                     $newGalleryImage->tour_package_id = $tourPackage->id;
        //                     $newGalleryImage->save();
        //                 }
        //             } elseif ($request->input('status' . $i) == 'deleted') {
        //                 $imageName = $request->input('image' . $i);
        //                 $galleryImage = GalleryImages::where('image', $imageName)->first();

        //                 if ($galleryImage) {
        //                     $filePath = public_path('uploads/album/' . $imageName);

        //                     if (file_exists($filePath)) {
        //                         File::delete($filePath);
        //                     }

        //                     $galleryImage->delete();
        //                 }
        //             }
        //         }
        //     }
        // }

        // return response()->json(['success' => true, 'message' => 'Album updated successfully.']);
    }

    public function delete($id)
    {

        $galleryImages = GalleryImages::where('id', $id)->get();
        foreach ($galleryImages as $galleryImage) {
            if (!empty($galleryImage->image)) {
                $filePath = public_path('uploads/album/' . $galleryImage->image);
                if (file_exists($filePath)) {
                    File::delete($filePath);
                }
            }
            $galleryImage->delete();
        }

        // Potentially, if deleting a tour package, delete its associated gallery images.
        // This method seems to be for deleting a single gallery image, not an album/tour package.
        // The original logic for deleting a gallery image seems correct if $id is GalleryImage id.
        // However, the route is /admin/delete-gallery/{id}, which might imply deleting a gallery (album/tour package)
        // For now, assuming $id is for GalleryImage and the logic is for deleting a single image.

        $galleryImage = GalleryImages::find($id);

        if (!$galleryImage) {
            return response()->json(['success' => false, 'message' => 'Image not found.']);
        }

        if (!empty($galleryImage->image_path)) {
            $filePath = public_path('uploads/album/' . $galleryImage->image_path); // Use image_path
            if (file_exists($filePath)) {
                File::delete($filePath);
            }
        }

        $galleryImage->delete();

        return response()->json(['success' => true, 'message' => 'Image deleted successfully.']);
    }
}
