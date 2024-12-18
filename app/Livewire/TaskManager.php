<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;

class TaskManager extends Component
{

    public $tasks;
    public $categories;

    public function mount()
    {
        $this->categories = auth()->user()->categories;
        $this->loadTasks();
    }
    public function loadTasks()
    {
        $query = auth()->user()->tasks();

        $this->tasks = $query->get();
    }

    public function toggleComplete($taskId)
    {
        $task = Task::find($taskId);
        $task->completed = !$task->completed;
        $task->completed_at = $task->completed ? now() : null;
        $task->save();
        $this->loadTasks();
    }
    public function render()
    {
        return view('livewire.task-manager');
    }
}
