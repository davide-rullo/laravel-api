<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'result' => Technology::all()
        ]);
    }




    public function show($slug)
    {
        $tech = Technology::with('projects')->where('slug', $slug)->first();
        if ($tech) {
            return response()->json([
                'success' => true,
                'result' => $tech
            ]);
        } else {
            return response()->json([
                'success' => false,
                'result' => 'Page not found'
            ]);
        }
    }
}
