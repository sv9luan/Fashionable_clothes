<div>
    <style>
        nav svg {
            height: 20px;
        }

        nav .hidden {
            display: block;
        }
    </style>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Trang chủ</a>
                    <span></span> Tài khoản của tôi
                    <span></span> Sản phẩm
                    <span></span> Thêm sản phẩm
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        Thêm sản phẩm
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('admin.products') }}" class="btn btn-success float-end">Tất
                                            cả sản phẩm</a>
                                    </div>
                                </div>

                            </div>
                            <div class="card-body">
                                @if (Session::has('message'))
                                    <div class="alert alert-success" role="alert">
                                        {{ Session::get('message') }}
                                    </div>
                                @endif
                                <form wire:submit.prevent="addProduct" enctype="multipart/form-data">
                                    <div class="mb-3 mt-3">
                                        <label for="name" class="form-label">Tên sản phẩm</label>
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Nhập tên sản phẩm" wire:model="name" wire:keyup="generateSlug">
                                        @error('name')
                                            <p class="alert alert-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="slug" class="form-label">Slug</label>
                                        <input type="text" class="form-control" name="slug" placeholder="Slug"
                                            wire:model="slug">
                                        @error('slug')
                                            <p class="alert alert-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="short_description" class="form-label">Mô tả ngắn</label>
                                        <textarea class="form-control" name="short_description"placeholder="Nhập  mô tả ngắn" wire:model="short_description">
                                        </textarea>
                                        @error('short_description')
                                            <p class="alert alert-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="description" class="form-label">Mô tả</label>
                                        <textarea class="form-control" name="description"placeholder="Nhập  mô tả" wire:model="description">
                                        </textarea>
                                        @error('description')
                                            <p class="alert alert-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="regular_price" class="form-label">Giá</label>
                                        <input type="text" class="form-control" name="regular_price"
                                            placeholder="Nhập giá" wire:model="regular_price">
                                        @error('regular_price')
                                            <p class="alert alert-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="sale_price" class="form-label">Giá khuyến mãi</label>
                                        <input type="text" class="form-control" name="sale_price"
                                            placeholder="Nhập giá khuyến mãi" wire:model="sale_price">
                                        @error('sale_price')
                                            <p class="alert alert-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="SKU" class="form-label">Mã sản phẩm</label>
                                        <input type="text" class="form-control" name="SKU"
                                            placeholder="Nhập mã sản phẩm" wire:model="SKU">
                                        @error('SKU')
                                            <p class="alert alert-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="stock_status" class="form-label" wire:model="stock_status">Tình
                                            trạng hàng</label>
                                        <select class="form-control" name="stock_status">
                                            <option value="instock">Còn hàng</option>
                                            <option value="outofstock">Hết hàng</option>
                                        </select>
                                        @error('stock_status')
                                            <p class="alert alert-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="featured" class="form-label" wire:model="featured">Sản phẩm nổi
                                            bật</label>
                                        <select class="form-control" name="featured">
                                            <option value="0">Nổi bật</option>
                                            <option value="1">Không nổi bật</option>
                                        </select>
                                        @error('featured')
                                            <p class="alert alert-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3 mt-3">
                                        <label for="quantity" class="form-label">Số lượng</label>
                                        <input type="text" class="form-control" name="quantity"
                                            placeholder="Nhập số lượng" wire:model="quantity">
                                        @error('quantity')
                                            <p class="alert alert-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="image" class="form-label">Hình ảnh</label>
                                        <input type="file" class="form-control" name="image"
                                            placeholder="Tải hình ảnh" wire:model="image">
                                        @if ($image)
                                            <img src="{{ $image->temporaryUrl() }}" width="120" alt="">
                                        @endif
                                        @error('image')
                                            <p class="alert alert-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3 mt-3">
                                        <label for="category_id" class="form-label">Danh mục</label>
                                        <select class="form-select" name="category_id" wire:model="category_id">
                                            <option value="">Chọn danh mục</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <p class="alert alert-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary float-end">Thêm</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
