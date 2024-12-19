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
    public $editingTask;
    public $editTaskTitle;
    public $editTaskDescription;
    public $editTaskCategory;
    public $selectedCategory;
    public $taskToDelete;
    public $showDeleteModal = false;
    public $showEditModal = false;
    public $showCompleted = null;

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


        if ($this->selectedCategory) {
            $query->where('category_id', $this->selectedCategory);
        }

        if ($this->showCompleted === true) {
            $query->where('completed', true);
        } elseif ($this->showCompleted === false) {
            $query->where('completed', false);
        }

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

    public function editTask($taskId)
    {
        $this->editingTask = Task::find($taskId);
        $this->editTaskTitle = $this->editingTask->title;
        $this->editTaskDescription = $this->editingTask->description;
        $this->editTaskCategory = $this->editingTask->category_id;
        $this->showEditModal = true;
    }

    public function updateTask()
    {
        $this->validate([
            'editTaskTitle' => 'required|min:3',
            'editTaskDescription' => 'nullable',
            'editTaskCategory' => 'nullable|exists:categories,id',
        ]);

        $this->editingTask->update([
            'title' => $this->editTaskTitle,
            'description' => $this->editTaskDescription,
            'category_id' => $this->editTaskCategory,
        ]);

        $this->showEditModal = false;
        $this->reset(['editingTask', 'editTaskTitle', 'editTaskDescription', 'editTaskCategory']);
        $this->loadTasks();
    }

    public function closeEditModal()
    {
        $this->showEditModal = false;
        $this->reset(['editingTask', 'editTaskTitle', 'editTaskDescription', 'editTaskCategory']);
    }

    public function toggleComplete($taskId)
    {
        $task = Task::find($taskId);
        $task->completed = !$task->completed;
        $task->completed_at = $task->completed ? now() : null;
        $task->save();
        $this->loadTasks();
    }

    public function confirmDelete($taskId)
    {
        $this->taskToDelete = Task::find($taskId);
        $this->showDeleteModal = true;
    }
    public function deleteTask()
    {
        if ($this->taskToDelete) {
            $this->taskToDelete->delete();
            $this->showDeleteModal = false;
            $this->taskToDelete = null;
            $this->loadTasks();
        }
    }

    public function cancelDelete()
    {
        $this->showDeleteModal = false;
        $this->taskToDelete = null;
    }

    public function filterByCategory($categoryId)
    {
        $this->selectedCategory = $categoryId;
        $this->loadTasks();
    }

    public function toggleShowCompleted()
    {
        $this->showCompleted = !$this->showCompleted;
        $this->loadTasks();
    }

    public function clearFilters()
    {
        $this->reset(['selectedCategory', 'showCompleted']);
        $this->loadTasks();
    }

    public function render()
    {
        return view('livewire.task-manager');
    }
}
