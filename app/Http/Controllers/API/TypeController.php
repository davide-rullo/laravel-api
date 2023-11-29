<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'result' => Type::all()
        ]);
    }

    public function show($slug)
    {
        $type = Type::with('projects')->where('slug', $slug)->first();
        if ($type) {
            return response()->json([
                'success' => true,
                'result' => $type
            ]);
        } else {
            return response()->json([
                'success' => false,
                'result' => 'Page not found'
            ]);
        }
    }
}
