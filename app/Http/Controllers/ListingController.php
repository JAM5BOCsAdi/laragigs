<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;
// use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    // Show all listings
    public function index()
    {
        // dd(Listing::latest()->try(request(['tag', 'search']))->paginate(2));
        // dd(request('tag'));
        return view('listings.index', [
            'listings' => Listing::latest()->try(request(['tag', 'search']))->paginate(6)
        ]);
    }

    // Show single listing
    public function show(Listing $listing)
    {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    // Show create form
    public function create()
    {
        return view('listings.create');
    }

    // Store Listing Data
    public function store(Request $request)
    {
        // dd($request->file('logo')->store());
        // dd($request->all());
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);



        return redirect('/')->with('message', 'Post created successfully!');
    }

    // Show Edit Form
    public function edit(Listing $listing)
    {
        // dd($listing->title);
        return view('listings.edit', ['listing' => $listing]);
    }


    // Update Listing Data
    public function update(Request $request, Listing $listing)
    {
        // Make sure logged in user is owner
        if ($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }


        // dd($request->file('logo')->store());
        // dd($request->all());
        $formFields = $request->validate([
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);



        return back()->with('message', 'Post updated successfully!');
    }

    // Delete Listing
    public function destroy(Listing $listing)
    {

        // Make sure logged in user is owner
        if ($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted successfully!');
    }

    // Manage Listings
    public function manage()
    {
        // Original:  "listings()" no working -> Undefined method 'listings'.intelephense(1013)
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);

        // Other way:
        // return view('listings.manage', ['listings' => Auth::user()->listings()->get()]);
    }
}
