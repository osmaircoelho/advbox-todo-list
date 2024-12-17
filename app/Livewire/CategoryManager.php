<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategoryManager extends Component
{

    public $categories;
    public $newCategoryName;
    public $editingCategoryId;
    public $editingCategory;
    public $editCategoryName;
    public $showEditModal = false;

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

    public function editCategory($categoryId)
    {
        $this->editingCategoryId = $categoryId;
        $this->editCategoryName = Category::find($categoryId)->name;
        $this->showEditModal = true;
    }

    public function updateCategory()
    {
        $this->validate([
            'editCategoryName' => 'required|min:3',
        ]);

        $category = Category::find($this->editingCategoryId);
        $category->update([
            'name' => $this->editCategoryName,
        ]);
        $this->showEditModal = false;
        $this->reset(['editingCategoryId', 'editCategoryName']);
        $this->loadCategories();
    }

    public function closeEditModal()
    {
        $this->showEditModal = false;
        $this->reset(['editingCategory', 'editCategoryName']);
    }


    public function render()
    {
        return view('livewire.category-manager');
    }


}
