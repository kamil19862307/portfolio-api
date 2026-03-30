<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        $projects = Project::select(['id', 'title', 'description', 'image', 'github_url'])
            ->with('technologies:name')
            ->orderBy('id', 'desc')
            ->limit(6)
            ->get();

        return view('index', compact('projects'));
    }
}
