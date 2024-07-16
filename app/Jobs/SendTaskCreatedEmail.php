<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Task;
use Illuminate\Support\Facades\Mail;
use App\Mail\TaskCreated;

class SendTaskCreatedEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $task;
    
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function handle()
    {

        if ($this->task->user && $this->task->user->email) {
            Mail::to($this->task->user->email)->send(new TaskCreated($this->task));
        }
    }
}
