<?php

// use Illuminate\Http\Request;

use App\Http\Controllers\ListingController;
use Illuminate\Support\Facades\Route;
use App\Models\Listing;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
    (Laragon) Project path: C:/laragon/www/laragigs
    (Laragon) Pretty url: http://laragigs.test
*/

// All Listings
Route::get('/', [ListingController::class, 'index']);

// Single Listing
Route::get('/listings/{listing}', [ListingController::class, 'show']);

// Common Resource Routes:
// index - Show all <listings>
// show - Show single <listing>
// create - Show form to create new <listing>
// store - Store new <listing>
// edit - Show form to edit <listing>
// update - Update <listing>
// destroy - Delete <listing>

// Route::get('/hello', function () {
//     return response('<h1>hello</h1>', 200)
//         ->header('Content-Type', 'text/plain')
//         ->header('foo', 'bar');
// });

// Route::get('/posts/{id}', function ($id) {
//     dd($id);
//     return response('Post ' . $id);
// })->where('id', '[0-9]+');

// Route::get('/search', function (Request $request) {
//     return ($request->name . ' ' . $request->city);
// });
