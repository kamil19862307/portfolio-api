<?php

namespace App\Http\Controllers\Api;

use App\DTOs\ProjectStoreDTO;
use App\DTOs\ProjectUpdateDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectStoreRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Http\Resources\Api\ProjectResource;
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
        return ProjectResource::collection($this->service->list($request->only('technologies')));
    }

//    Тебе приходилось собственный декоратор писать?
//    Да
//    Давай, допустим, у нас есть какая-то функция, такая капризная, она иногда падает, допустим в сеть какуюто ходит.
//    И мы хотим сделать ей retry. Можем начать с простого, без аргументов, просто чтоб как минимум,
//    три раза наша функция вызвалась.

    public function show(string $slug)
    {
        return new ProjectResource($this->service->show($slug));
    }

    public function store (ProjectStoreRequest $request)
    {
        $dto = new ProjectStoreDTO(...$request->validated());

        return new ProjectResource($this->service->store($dto));
    }

    public function update(string $slug, ProjectUpdateRequest $request)
    {
        $dto = new ProjectUpdateDTO(...$request->validated());

        return new ProjectResource($this->service->update($slug, $dto));
    }

    public function delete(string $slug)
    {
        $this->service->delete($slug);

        return response('Project deleted successfully', 200);
    }
}
