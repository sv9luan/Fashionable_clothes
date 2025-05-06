<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\HomeSlider;

class AdminHomeSliderComponent extends Component
{
    public $slide_id;

    public function deleteSlide()
    {
        $slide = HomeSlider::find($this->slide_id);
        unlink('assets/imgs/slides/' . $slide->image);
        $slide->delete();
        session()->flash('message', 'Xoá thành công');
       // return redirect()->route('admin.home.slider');
    }
    public function render()
    {
        $sliders = HomeSlider::orderBy('created_at', 'desc')->get();
        return view('livewire.admin.admin-home-slider-component', ['sliders' => $sliders]);
    }
}
