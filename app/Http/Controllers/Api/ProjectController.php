<?php

namespace App\Http\Controllers\Api;

use App\Events\ProjectLiked;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Models\ProjectLike;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProjectController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $projects = Project::withCount('likes')
            ->orderByDesc('started_at')
            ->get();

        return ProjectResource::collection($projects);
    }

    public function show(string $slug): ProjectResource
    {
        $project = Project::where('slug', $slug)
            ->withCount('likes')
            ->with([
                'images'       => fn ($q) => $q->orderBy('sort_order'),
                'timelines'    => fn ($q) => $q->orderBy('occurred_at'),
                'contributors',
                'links'        => fn ($q) => $q->orderBy('sort_order'),
            ])
            ->firstOrFail();

        return new ProjectResource($project);
    }

    public function like(Request $request, string $slug): JsonResponse
    {
        $project     = Project::where('slug', $slug)->firstOrFail();
        $fingerprint = $this->fingerprint($request);

        ProjectLike::firstOrCreate([
            'project_id'  => $project->id,
            'fingerprint' => $fingerprint,
        ]);

        $count = $project->likes()->count();

        broadcast(new ProjectLiked($slug, $count));

        return response()->json([
            'likes_count' => $count,
            'liked'       => true,
        ]);
    }

    public function unlike(Request $request, string $slug): JsonResponse
    {
        $project     = Project::where('slug', $slug)->firstOrFail();
        $fingerprint = $this->fingerprint($request);

        ProjectLike::where('project_id', $project->id)
            ->where('fingerprint', $fingerprint)
            ->delete();

        $count = $project->likes()->count();

        broadcast(new ProjectLiked($slug, $count));

        return response()->json([
            'likes_count' => $count,
            'liked'       => false,
        ]);
    }

    public function likeStatus(Request $request, string $slug): JsonResponse
    {
        $project     = Project::where('slug', $slug)->firstOrFail();
        $fingerprint = $this->fingerprint($request);

        $liked = ProjectLike::where('project_id', $project->id)
            ->where('fingerprint', $fingerprint)
            ->exists();

        return response()->json([
            'likes_count' => $project->likes()->count(),
            'liked'       => $liked,
        ]);
    }

    private function fingerprint(Request $request): string
    {
        $raw = $request->ip() . '|' . $request->userAgent();
        return hash('sha256', $raw);
    }
}