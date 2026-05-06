<?php

namespace App\Notifications;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewComment extends Notification
{
    use Queueable;

    public function __construct(public Comment $comment)
    {
        $this->comment->loadMissing(['task:id,title', 'user:id,name']);
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
            'type' => 'new_comment',
            'task_id' => $this->comment->task_id,
            'task_title' => $this->comment->task->title,
            'comment_id' => $this->comment->id,
            'author_id' => $this->comment->user_id,
            'author_name' => $this->comment->user->name,
            'preview' => \Illuminate\Support\Str::limit(strip_tags($this->comment->body), 120),
        ];
    }
}
