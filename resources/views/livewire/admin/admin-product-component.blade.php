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
                                        Tất cả sản phẩm
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('admin.product.add') }}"
                                            class="btn btn-success float-end">Thêm sản phẩm</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @if (Session::has('message'))
                                    <div class="alert alert-success" role="alert">
                                        {{ Session::get('message') }}
                                    </div>
                                @endif
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Hình ảnh</th>
                                                <th>Tên</th>
                                                <th>Trạng thái</th>
                                                <th>Giá</th>
                                                <th>Danh mục</th>
                                                <th>Ngày</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = ($products->currentPage() - 1) * $products->perPage();
                                            @endphp
                                            @foreach ($products as $product)
                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    <td><img src="{{ asset('assets/imgs/products') }}/{{ $product->image }}"
                                                            alt="{{ $product->name }}" width="60"></td>
                                                    <td>{{ $product->name }}</td>
                                                    <td>
                                                        @if ($product->stock_status === 'instock')
                                                            Còn hàng
                                                        @else
                                                            Hết hàng
                                                        @endif
                                                    </td>
                                                    <td>{{ $product->regular_price }}0đ</td>
                                                    <td>{{ $product->category->name }}</td>
                                                    <td>{{ $product->created_at }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.product.edit', ['product_id' => $product->id]) }}"
                                                            class="text-info ">Sửa
                                                        </a>
                                                        <a href="#" class="text-danger"
                                                            onclick="deleteConfirmation({{ $product->id }})">Xóa
                                                        </a>

                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $products->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>

<div class="modal" id="deleteConfirmation">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Xoá sản phẩm</h5>
                <button type="button" class="btn-close" data-bs-toggle="modal"
                    data-bs-target="#deleteConfirmation"></button>
            </div>
            <div class="modal-body">
                Bạn có chắc chắn muốn xoá sản phẩm này không?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                    data-bs-target="#deleteConfirmation">Đóng</button>
                <button type="button" class="btn btn-danger" onclick="deleteProduct()">Xoá</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        function deleteConfirmation(id) {
            @this.set('product_id', id);
            $('#deleteConfirmation').modal('show');
        }

        function deleteProduct() {
            @this.call('deleteProduct');
            $('#deleteConfirmation').modal('hide');
        }
    </script>
@endpush
