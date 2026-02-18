<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ProjectService;

class ProjectController extends Controller
{
    public function __construct(
        private ProjectService $service
    )
    {}

    public function index()
    {
        return response()->json($this->service->list());
    }

    public function show(string $slug)
    {
        return response()->json($this->service->show($slug));
    }

    public function delete(string $slug)
    {
        $this->service->delete($slug);

        return response('Project deleted successfully', 200);
    }
}
