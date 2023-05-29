<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use RealRashid\SweetAlert\Facades\Alert;


class AdminAddCategoriesComponent extends Component
{
    use LivewireAlert;

    public $name;
    public $slug;

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }
    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'name' => 'required',
            'slug' => 'required',
        ]);
    }

    public function storeCategory()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required',
        ]);
        $category = new Category();
        $category->name = $this->name;
        $category->slug = $this->slug;
        $category->save();

        

        $this->flash('success','Category has been Created Successfully!', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => false,
           ]);

           $this->name = "";
            $this->slug = "";

        return redirect()->route('admin.categories');
        

       
    }
    public function render()
    {
      
        return view('livewire.admin.admin-add-categories-component');
    }
}
