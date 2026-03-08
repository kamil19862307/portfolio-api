<?php

namespace App\Http\Controllers\Api;

use App\DTOs\ProjectStoreDTO;
use App\DTOs\ProjectUpdateDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectStoreRequest;
use App\Http\Requests\ProjectUpdateRequest;
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

    public function store (ProjectStoreRequest $request)
    {
        $dto = new ProjectStoreDTO(...$request->validated());

        return response()->json($this->service->store($dto));
    }

    public function update(string $slug, ProjectUpdateRequest $request)
    {
        $dto = new ProjectUpdateDTO(...$request->validated());

        return response()->json($this->service->update($slug, $dto));
    }

    public function delete(string $slug)
    {
        $this->service->delete($slug);

        return response('Project deleted successfully', 200);
    }
}
