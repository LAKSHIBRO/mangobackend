<?php

namespace App\Http\Controllers;

use App\Models\TourPackage;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class TourPackageController extends Controller
{
    public function index()
    {


        return view('frontend.pages.tpd',);
    }

    public function show($slug)
    {
        $tourPackage = TourPackage::where('slug', $slug)
            ->where('active', true)
            ->with(['itinerary', 'galleryImages', 'category']) // Added 'category'
            ->firstOrFail();

        return view('frontend.pages.tour_package_detail', compact('tourPackage'));
    }

    public function tailorMade()
    {
        $tours = TourPackage::where('type', 'tailor-made')
            ->where('active', true)
            ->get();

        return view('frontend.pages.tailor_made_tours', compact('tours'));
    }

    public function roundTour()
    {
        $tours = TourPackage::where('type', 'round-tour')
            ->where('active', true)
            ->get();

        return view('frontend.pages.round_tours', compact('tours'));
    }

    public function tpd()
    {
        // This is a template view for the TPD (Tour Package Detail) showcase
        return view('frontend.pages.tpd');
    }

    public function inquire(Request $request)
    {
        $request->validate([
            'tour_id' => 'required|exists:tour_packages,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'date' => 'required|date',
            'adults' => 'required|integer|min:1',
            'children' => 'nullable|integer|min:0',
            'message' => 'nullable|string',
        ]);

        // Create a new inquiry in the database
        $inquiry = Inquiry::create([
            'tour_id' => $request->tour_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'date' => $request->date,
            'adults' => $request->adults,
            'children' => $request->children ?? 0,
            'message' => $request->message,
            'status' => 'new',
        ]);

        // Optional: You could send an email notification here
        // Mail::to('your@email.com')->send(new NewInquiryNotification($inquiry));

        return redirect()->back()->with('success', 'Your inquiry has been sent successfully! We will contact you soon.');
    }
}
