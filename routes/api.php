<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Project;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('projects', function () {
    return response()->json([
        'success' => true,
        'result' => Project::with('type', 'technologies')->orderByDesc('id')->paginate(12)
    ]);
});

Route::get('projects/{project:slug}', function ($slug) {

    $project = Project::with('type', 'technologies')->where('slug', $slug)->first();

    if ($project) {
        return response()->json([
            'success' => True,
            'result' => $project
        ]);
    } else {

        return response()->json([
            'success' => false,
            'result' => 'Page not found'
        ]);
    }
});
