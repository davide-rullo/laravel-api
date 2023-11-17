<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class DashboardController extends Controller
{
    public function index()
    {

        $total_projects = Project::all()->count();
        return view('admin.dashboard', compact('total_projects'));
    }
}
