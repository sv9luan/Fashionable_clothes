<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\HomeSlider;

class AdminHomeSliderComponent extends Component
{
    public function render()
    {
        $sliders = HomeSlider::orderBy('created_at', 'desc')->get();
        return view('livewire.admin.admin-home-slider-component', ['sliders' => $sliders]);
    }
}
