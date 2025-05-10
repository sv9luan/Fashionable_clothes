<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\HomeSlider;
use App\Models\Product;
use App\Models\Category;
use Cart;

class HomeComponent extends Component
{
    public function store($product_id, $product_name, $product_price)
    {
        Cart::instance('cart')->add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        session()->flash('success_message', 'Item added in cart');
        $this->emitTo('cart-icon-component', 'refreshComponent');
        return redirect()->route('shop.cart');
    }

    public function render()
    {
        $sliders = HomeSlider::where('status', 1)->get();
        $lproducts = Product::orderBy('created_at', 'desc')->take(8)->get();
        $fproducts = Product::where('featured', 1)->inRandomOrder()->take(8)->get();
        $pcategories = Category::where('is_popular', 1)->inRandomOrder()->take(8)->get();
        return view('livewire.home-component', ['sliders' => $sliders, 'lproducts' => $lproducts, 'fproducts' => $fproducts, 'pcategories' => $pcategories]);
    }
}