<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class AdminEditCategoryComponent extends Component
{
    use WithFileUploads;
    public $category_id;
    public $name;
    public $slug;
    public $image;
    public $is_pupolar = 0;
    public $newimage;

    public function mount($category_id)
    {
        $category = Category::find($this->category_id);
        $this->category_id = $category_id;
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->image = $category->image;
        $this->is_popular = $category->is_popular;
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'slug' => 'required',
        ]);
    }

    public function updateCategory()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required',
        ]);

        $category = Category::find($this->category_id);
        $category->name = $this->name;
        $category->slug = $this->slug;
        if ($this->newimage) {
            // unlink('assets/imgs/categories/' . $category->newimage);
            $imageName = Carbon::now()->timestamp . '.' . $this->newimage->extension();
            $this->newimage->storeAs('categories', $imageName);
            $category->image = $imageName;
            
        }
        $category->is_popular = $this->is_popular;
        $category->save();

        session()->flash('message', 'Cập nhật danh mục thành công!');
    }
    public function render()
    {
        return view('livewire.admin.admin-edit-category-component');
    }
}
