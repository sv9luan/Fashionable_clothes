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
                    <span></span> Cập nhật Slide
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
                                        Cập nhật Slide
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('admin.home.slider') }}" class="btn btn-success float-end">Tất
                                            cả Slide</a>
                                    </div>
                                </div>

                            </div>
                            <div class="card-body">
                                @if (Session::has('message'))
                                    <div class="alert alert-success" role="alert">
                                        {{ Session::get('message') }}
                                    </div>
                                @endif
                                <form wire:submit.prevent="updateSlide">
                                    <div class="mb-3 mt-3">
                                        <label class="form-label">Top Title</label>
                                        <input type="text" class="form-control" placeholder="Nhập Top Title"
                                            wire:model="top_title">
                                        @error('top_title')
                                            <p class="alert alert-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label class="form-label">Title</label>
                                        <input type="text" class="form-control" placeholder="Nhập title"
                                            wire:model="title">
                                        @error('title')
                                            <p class="alert alert-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label class="form-label">Sub Title</label>
                                        <input type="text" class="form-control" placeholder="Nhập sub title"
                                            wire:model="sub_title">
                                        @error('sub_title')
                                            <p class="alert alert-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label class="form-label">Offer</label>
                                        <input type="text" class="form-control" placeholder="Nhập offer"
                                            wire:model="offer">
                                        @error('offer')
                                            <p class="alert alert-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label class="form-label">Link</label>
                                        <input type="text" class="form-control" placeholder="Nhập link"
                                            wire:model="link">
                                        @error('link')
                                            <p class="alert alert-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label class="form-label">Status</label>
                                        <select class="form-select" wire:model="status">
                                            <option value="1">Hiện</option>
                                            <option value="0">Ẩn</option>
                                        </select>
                                        @error('status')
                                            <p class="alert alert-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3 mt-3">
                                        <label class="form-label">Hình ảnh</label>
                                        <input type="file" class="form-control" wire:model="new_image">
                                        @if ($new_image)
                                            <img src="{{ $new_image->temporaryUrl() }}" width="120" alt="">
                                        @else
                                            <img src="{{ asset('assets/imgs/slides') }}/{{ $image }}"
                                                width="120" alt="">
                                        @endif
                                        @error('new_image')
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
