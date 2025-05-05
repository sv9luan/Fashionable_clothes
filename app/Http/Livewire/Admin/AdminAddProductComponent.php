<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Livewire\WithFileUploads;

class AdminAddProductComponent extends Component
{
    use WithFileUploads;
    public $name;
    public $slug;
    public $short_description;
    public $description;
    public $regular_price;
    public $sale_price;
    public $SKU;
    public $stock_status = 'instock';
    public $quantity;
    public $featured = 0;
    public $image;
    public $category_id;

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function addProduct()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required|unique:products',
            'short_description' => 'required',
            'description' => 'required',
            'regular_price' => 'required|numeric',
            'sale_price' => 'required|unique:products',
            'quantity' => 'required|numeric',
            'SKU' => 'required|unique:products',
            'stock_status' => 'required',
            'featured' => 'required',
            'image' => 'required|image|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

    
        $product = new Product();
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->short_description = $this->short_description;
        $product->description = $this->description;
        $product->regular_price = $this->regular_price;    
        $product->sale_price = $this->sale_price;   
        $product->SKU = $this->SKU;
        $product->stock_status = $this->stock_status;
        $product->featured = $this->featured;
        $product->quantity = $this->quantity;
        $imageName = Carbon::now()->timestamp . '.' . $this->image->extension();
        $this->image->storeAs('products', $imageName);
        $product->image = $imageName;
        $product->category_id = $this->category_id;
        $product->save();
        session()->flash('message', 'Đã thêm sản phẩm mới!');
        return redirect()->route('admin.products');
    }

    public function render()
    {
        $categories = Category::orderBy('created_at', 'ASC')->get();
        return view('livewire.admin.admin-add-product-component', [
            'categories' => $categories,
        ]);
    }
}
