<?php

namespace App\Livewire;

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
    public function render()
    {
        return view('livewire.task-manager');
    }
}
