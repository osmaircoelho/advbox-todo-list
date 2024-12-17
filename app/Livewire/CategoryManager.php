<?php

namespace App\Livewire;

use Livewire\Component;

class CategoryManager extends Component
{

    public $categories;
    public $newCategoryName;

    protected $rules = [
        'newCategoryName' => 'required|min:3',
    ];

    public function mount(){
        $this->loadCategories();
    }

    public function loadCategories()
    {
        $this->categories = auth()->user()->categories;
    }

    public function addCategory()
    {
        $this->validate();

        auth()->user()->categories()->create([
            'name' => $this->newCategoryName,
        ]);

        $this->reset('newCategoryName');
        $this->loadCategories();
    }


    public function render()
    {
        return view('livewire.category-manager');
    }


}
