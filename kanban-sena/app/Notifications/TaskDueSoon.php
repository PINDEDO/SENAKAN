<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

/**
 * Fecha límite próxima (RF-008). Disparar desde comando programado o al guardar la tarea.
 */
class TaskDueSoon extends Notification
{
    use Queueable;

    public function __construct(public Task $task)
    {
        $this->task->loadMissing('project:id,name');
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'task_due_soon',
            'task_id' => $this->task->id,
            'task_title' => $this->task->title,
            'due_date' => $this->task->due_date?->toDateString(),
            'project_name' => $this->task->project->name ?? '',
            'message' => 'La fecha límite de una tarea asignada está próxima.',
        ];
    }
}
