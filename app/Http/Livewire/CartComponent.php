<?php

namespace App\Http\Livewire;
use Livewire\Component;

use Cart;

class CartComponent extends Component
{
    public function increaseQuantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty + 1;
        Cart::instance('cart')->update($rowId, $qty );
        $this->emitTo('cart-icon-component', 'refreshComponent');
    }

    public function decreaseQuantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty - 1;
        Cart::instance('cart')->update($rowId, $qty );
        $this->emitTo('cart-icon-component', 'refreshComponent');
    }
    public function destroy($rowId)
    {
        Cart::instance('cart')->remove($rowId);
        session()->flash('success_message', 'Item has been removed from cart');
        $this->emitTo('cart-icon-component', 'refreshComponent');
    }

    public function clearCartAll()
    {
        Cart::instance('cart')->destroy();
        session()->flash('success_message', 'All items have been removed from cart');
        $this->emitTo('cart-icon-component', 'refreshComponent');
    }

    public function render()
    {
        return view('livewire.cart-component');
    }
}
