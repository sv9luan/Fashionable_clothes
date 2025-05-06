<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\HomeSlider;
use Carbon\Carbon;

class AdminEditSlideComponent extends Component
{
    use WithFileUploads;
    public $top_title;
    public $title;
    public $sub_title;
    public $link;
    public $offer;
    public $image;
    public $status = 1;
    public $slide_id;
    public $new_image;

    public function mount($slide_id)
    {
        $this->slide_id = $slide_id;
        $slide = HomeSlider::find($this->slide_id);
        $this->top_title = $slide->top_title;
        $this->title = $slide->title;
        $this->sub_title = $slide->sub_title;
        $this->link = $slide->link;
        $this->offer = $slide->offer;
        $this->image = $slide->image;
        $this->status = $slide->status;
    }

    public function updateSlide()
    {
        $this->validate([
            'top_title' => 'required',
            'title' => 'required',
            'sub_title' => 'required',
            'offer' => 'required',
            'link' => 'required',
            
            'status' => 'required'
        ]);

        $slide = HomeSlider::find($this->slide_id);
        $slide->top_title = $this->top_title;
        $slide->title = $this->title;
        $slide->sub_title = $this->sub_title;
        $slide->offer = $this->offer;
        $slide->link = $this->link;
        if ($this->new_image) {
            unlink('assets/imgs/slides/' . $slide->image);
            $imageName = Carbon::now()->timestamp . '.' . $this->new_image->extension();
            $this->new_image->storeAs('slides', $imageName);
            $slide->image = $imageName;
        } 
        $slide->image = $imageName;
        $slide->status = $this->status;
        $slide->save();

        session()->flash('message', 'Cập nhật thành công');
        
    }
    public function render()
    {
        return view('livewire.admin.admin-edit-slide-component');
    }
}
