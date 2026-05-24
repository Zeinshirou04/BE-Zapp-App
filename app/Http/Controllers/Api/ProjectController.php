<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProjectController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $projects = Project::orderByDesc('started_at')->get();

        return ProjectResource::collection($projects);
    }

    public function show(string $slug): ProjectResource
    {
        $project = Project::where('slug', $slug)
            ->with(['images' => fn($q) => $q->orderBy('sort_order'), 'timelines' => fn($q) => $q->orderBy('occurred_at'), 'contributors'])
            ->firstOrFail();

        return new ProjectResource($project);
    }
}
