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
                    <span></span> Danh mục
                    <span></span> Cập nhật danh mục
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
                                        Cập nhật danh mục
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('admin.categories') }}" class="btn btn-success float-end">Tất
                                            cả danh mục</a>
                                    </div>
                                </div>

                            </div>
                            <div class="card-body">
                                @if (Session::has('message'))
                                    <div class="alert alert-success" role="alert">
                                        {{ Session::get('message') }}
                                    </div>
                                @endif
                                <form wire:submit.prevent="updateCategory">
                                    <div class="mb-3 mt-3">
                                        <label for="name" class="form-label">Tên danh mục</label>
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Nhập tên danh mục" wire:model="name" wire:keyup="generateSlug">
                                        @error('name')
                                            <p class="alert alert-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="slug" class="form-label">Slug</label>
                                        <input type="text" class="form-control" name="slug"
                                            placeholder="Nhập slug danh mục" wire:model="slug">
                                        @error('slug')
                                            <p class="alert alert-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="slug" class="form-label">Hình ảnh</label>
                                        <input type="file" class="form-control" name="image" wire:model="newimage">
                                        @error('newimage')
                                            <p class="alert alert-danger mt-2">{{ $message }}</p>
                                        @enderror
                                        @if ($newimage)
                                            <div class="mt-3">
                                                <img src="{{ $newimage->temporaryUrl() }}" width="120"
                                                    alt="">
                                            </div>
                                        @else
                                            {{-- <div class="mt-3">
                                                <img src="{{ asset('assets/imgs/categories') }}/{{ $cartegory->image }}"
                                                    width="120" alt="">
                                            </div> --}}
                                        @endif
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="is_popular" class="form-label">Trạng thái</label>
                                        <select class="form-control" wire:model="is_popular">
                                            <option value="0">Không</option>
                                            <option value="1">Có</option>
                                        </select>
                                        @error('is_popular')
                                            <p class="alert alert-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary float-end">Cập nhật</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
