<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
class AdminProductComponent extends Component
{
    public $product_id;
    use WithPagination;
    public function deleteProduct()
    {
        $product = Product::find($this->product_id);
        if ($product) {
            unlink('assets/imgs/products/' . $product->image);
            $product->delete();
            session()->flash('message', 'Xoá sản phẩm thành công!');
        }
    }

    public function render()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(10);
        return view('livewire.admin.admin-product-component', [
            'products' => $products,
        ]);
    }
}
