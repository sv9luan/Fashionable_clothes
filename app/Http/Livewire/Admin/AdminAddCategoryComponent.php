<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class AdminAddCategoryComponent extends Component
{
    use WithFileUploads;
    public $name;
    public $slug;
    public $image;
    public $is_popular = 0;

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'slug' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    }

    public function storeCategory()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $category = new Category();
        $category->name = $this->name;
        $category->slug = $this->slug;
        $imageName = time() . '.' . $this->image->extension();
        $this->image->storeAs('categories', $imageName);
        $caregory->is_popular = $this->is_popular;
        $category->save();

        session()->flash('message', 'Thêm danh mục thành công!');
    }

    public function render()
    {
       
        return view('livewire.admin.admin-add-category-component');
    }
}
