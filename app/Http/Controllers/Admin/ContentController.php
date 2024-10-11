<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\select;

class ContentController extends Controller
{
   
    public function create()
{
    $contents = Content::all();
    return view('admin.create', compact('contents'));
}

public function store(Request $request)
{
    // Validate the incoming request data
    $request->validate([
        'slug' => 'required|unique:contents,slug|max:255',
        'title' => 'required|max:255',
        'body' => 'required',
        'website' => 'required', // Ensure the website is a valid URL
    ]);

    // Create new content
    $content = Content::create([
        'slug' => $request->slug,
        'title' => $request->title,
        'body' => $request->body,
        'website' => $request->website, // Store the website
    ]);

    // Redirect back to the form with success message and pass the created content's ID
    return redirect()->route('admin.create')->with([
        'success' => 'Content added successfully!',
    ]);
}

public function show($website, $slug)
{
    Log::info('Function show() called with website: ' . $website . ' and slug: ' . $slug);

    // Fetch content from the database using raw SQL query
    $content = DB::select("SELECT * FROM `contents` WHERE slug = ? AND website = ?", [$slug, $website]);

    if (!empty($content)) {
        // Since DB::select returns an array of objects, we'll access the first item
        $content = $content[0]; // Access the first item of the array
        Log::info('Content found: ', (array) $content); // Convert object to array for logging

        // Return the content as a view, and pass the content object
        return view('show', compact('content'));
    } else {
        Log::warning('Content not found for slug: ' . $slug);
        return response()->json([
            'success' => false,
            'message' => 'Content not found'
        ], 404);
    }
}





}
