<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'result' => Project::with('type', 'technologies')->orderByDesc('id')->paginate(15)
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
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
    }

    public function latest()
    {
        return response()->json([
            'success' => true,
            'result' => Project::with('type', 'technologies')->orderByDesc('id')->take(3)->get()
        ]);
    }
}
