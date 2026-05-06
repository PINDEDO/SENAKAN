<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Task;
use App\Models\User;
use App\Notifications\NewComment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    use AuthorizesRequests;

    /**
     * Listado paginado (JSON) — evita N+1 con user cargado.
     */
    public function index(Task $task): JsonResponse
    {
        $this->authorize('update', $task);

        $comments = $task->comments()
            ->with(['user:id,name,avatar'])
            ->paginate(10);

        return response()->json($comments);
    }

    public function store(Request $request, Task $task): JsonResponse
    {
        $this->authorize('update', $task);

        $validated = $request->validate([
            'body' => ['required', 'string', 'max:5000'],
        ]);

        $comment = $task->comments()->create([
            'user_id' => $request->user()->id,
            'body' => $validated['body'],
        ]);

        $comment->load('user:id,name,avatar');

        $this->notifyStakeholdersNewComment($task, $comment, $request->user());

        return response()->json([
            'comment' => $comment,
            'message' => 'Comentario publicado.',
        ], 201);
    }

    public function update(Request $request, Comment $comment): JsonResponse
    {
        $this->authorize('update', $comment);

        $validated = $request->validate([
            'body' => ['required', 'string', 'max:5000'],
        ]);

        $comment->update(['body' => $validated['body']]);
        $comment->load('user:id,name,avatar');

        return response()->json([
            'comment' => $comment,
            'message' => 'Comentario actualizado.',
        ]);
    }

    public function destroy(Comment $comment): JsonResponse
    {
        $this->authorize('delete', $comment);
        $comment->delete();

        return response()->json(['message' => 'Comentario eliminado.']);
    }

    /**
     * Notifica asignado y creador de la tarea (no al autor del comentario).
     */
    private function notifyStakeholdersNewComment(Task $task, Comment $comment, User $actor): void
    {
        $task->loadMissing(['assignee', 'creator']);

        $ids = collect([$task->assigned_to, $task->created_by])
            ->filter()
            ->unique()
            ->reject(fn ($id) => (int) $id === (int) $actor->id);

        foreach ($ids as $userId) {
            $user = User::find($userId);
            if ($user) {
                $user->notify(new NewComment($comment));
            }
        }
    }
}
