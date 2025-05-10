<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AdminEditProductComponent extends Component
{
    use WithFileUploads;
    public $product_id;
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
    public $newimage;

    public function mount($product_id)
    {
        $product = Product::find($product_id);
        $this->product_id = $product->id;
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->short_description = $product->short_description;
        $this->description = $product->description;
        $this->regular_price = $product->regular_price;
        $this->sale_price = $product->sale_price;
        $this->SKU = $product->SKU;
        $this->stock_status = $product->stock_status;
        $this->quantity = $product->quantity;
        $this->featured = $product->featured;
        $this->image = $product->image;
        $this->category_id = $product->category_id;
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function updateProduct()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required',
            'short_description' => 'required',
            'description' => 'required',
            'regular_price' => 'required',
            'sale_price' => 'required',
            'quantity' => 'required',
            'SKU' => 'required',
            'stock_status' => 'required',
            'featured' => 'required',
            'newimage' => 'nullable|image|max:2048',
            'category_id' => 'required',
        ]);

    
        $product = Product::find($this->product_id);
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
        if ($this->newimage) {
            unlink('assets/imgs/products/' . $product->image);
            $imageName = Carbon::now()->timestamp . '.' . $this->newimage->extension();
            $this->newimage->storeAs('products', $imageName);
            $product->image = $imageName;
        }
        
       
        $product->category_id = $this->category_id;
        $product->save();
        session()->flash('message', 'Đã cập nhật sản phẩm!');
        return redirect()->route('admin.products');
    }

    public function render()
    {
        $categories = Category::orderBy('created_at', 'ASC')->get();
        return view('livewire.admin.admin-edit-product-component', ['categories' => $categories]);
    }
}
