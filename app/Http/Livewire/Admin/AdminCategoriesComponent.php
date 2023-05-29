<?php

namespace App\Http\Livewire\Admin;


use Livewire\Livewire;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use RealRashid\SweetAlert\Facades\Alert;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class AdminCategoriesComponent extends Component
{   
    use LivewireAlert;

    use WithPagination;
    public $delete_id;

    protected $listeners = ['delete-confirmed' => 'deleteCategory'];

    public function deleteConfermation($Id)
    {
        $this->delete_id = $Id;
        $this->dispatchBrowserEvent('show-delete-confermation');
           
    }
    
    public function deleteCategory()
    {
        $category = Category::where('id', $this->delete_id)->first();
        $category->delete();
        $this->dispatchBrowserEvent('categoryDeleted');

    }
    

    public function render()
    {

        $categories = Category::orderBy('name', 'ASC')->paginate(5);
        
        return view('livewire.admin.admin-categories-component', compact('categories'));
    }
}
