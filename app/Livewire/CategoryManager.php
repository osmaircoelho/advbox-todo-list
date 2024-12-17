<?php

namespace App\Livewire;

use Livewire\Component;

class CategoryManager extends Component
{

    public $categories;

    public function mount(){
        $this->loadCategories();
    }

    public function loadCategories()
    {
        $this->categories = auth()->user()->categories;
    }


    public function render()
    {
        return view('livewire.category-manager');
    }


}
