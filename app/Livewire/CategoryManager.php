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
    public $showDeleteModal = false;
    public $categoryToDelete;

    protected $rules = [
        'newCategoryName' => 'required|min:3',
    ];

    protected $messages = [
        'newCategoryName.required' => 'The category name is required.',
        'newCategoryName.min' => 'The category name must be at least 3 characters.',
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
        $this->editingCategory = Category::find($categoryId);
        $this->editCategoryName = $this->editingCategory->name;
        $this->showEditModal = true;
    }

    public function updateCategory()
    {
        $this->validate([
            'editCategoryName' => 'required|min:3',
        ]);

        $this->editingCategory->update([
            'name' => $this->editCategoryName,
        ]);

        $this->showEditModal = false;
        $this->reset(['editingCategory', 'editCategoryName']);
        $this->loadCategories();
    }

    public function closeEditModal()
    {
        $this->showEditModal = false;
        $this->reset(['editingCategory', 'editCategoryName']);
    }

    public function confirmDelete($categoryId)
    {
        $this->categoryToDelete = Category::find($categoryId);
        $this->showDeleteModal = true;
    }

    public function deleteCategory()
    {
        if ($this->categoryToDelete) {
            $this->categoryToDelete->delete();
            $this->showDeleteModal = false;
            $this->categoryToDelete = null;
            $this->loadCategories();
        }
    }

    public function cancelDelete()
    {
        $this->showDeleteModal = false;
        $this->categoryToDelete = null;
    }

    public function render()
    {
        return view('livewire.category-manager');
    }

}
