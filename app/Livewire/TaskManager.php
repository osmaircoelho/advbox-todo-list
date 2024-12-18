<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;

class TaskManager extends Component
{

    public $tasks;
    public $categories;
    public $newTaskTitle;
    public $newTaskDescription;
    public $newTaskCategory;

    protected $rules = [
        'newTaskTitle' => 'required|min:3',
        'newTaskDescription' => 'nullable',
        'newTaskCategory' => 'nullable|exists:categories,id',
    ];

    protected $messages = [
        'newTaskTitle.required' => 'The task title is required.',
        'newTaskTitle.min' => 'The task title must be at least 3 characters.',
        'newTaskCategory.exists' => 'The selected category is invalid.',
    ];

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

    public function addTask()
    {
        $validatedData = $this->validate();

        auth()->user()->tasks()->create([
            'title' => $this->newTaskTitle,
            'description' => $this->newTaskDescription,
            'category_id' => $this->newTaskCategory,
        ]);

        $this->reset(['newTaskTitle', 'newTaskDescription', 'newTaskCategory']);
        $this->loadTasks();
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
