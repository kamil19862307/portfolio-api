<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ProjectService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct(
        private ProjectService $service
    )
    {}

    public function index(Request $request)
    {
        return response()->json($this->service->list($request->only('technologies')));
    }

    public function show(string $slug)
    {
        return response()->json($this->service->show($slug));
    }

    public function store (Request $request)
    {
        return response()->json($this->service->store($request->all()));
    }

    public function update(string $slug, Request $request)
    {
        return response()->json($this->service->update($slug, $request->all()));
    }

    public function delete(string $slug)
    {
        $this->service->delete($slug);

        return response('Project deleted successfully', 200);
    }
}
