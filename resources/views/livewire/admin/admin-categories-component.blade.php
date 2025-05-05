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
                                        Tất cả danh mục
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('admin.category.add') }}"
                                            class="btn btn-success float-end">Thêm danh mục</a>
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
                                                <th>Tên danh mục</th>
                                                <th>Slug</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = ($categories->currentPage() - 1) * $categories->perPage();
                                            @endphp
                                            @foreach ($categories as $category)
                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $category->name }}</td>
                                                    <td>{{ $category->slug }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.category.edit', ['category_id' => $category->id]) }}"
                                                            class="text-info">Sửa
                                                        </a>
                                                        <a href="#" class="text-danger"
                                                            onclick="deleteConfirmation({{ $category->id }})"
                                                            style="margin-left: 20px">Xoá
                                                        </a>

                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $categories->links() }}
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
                <h5 class="modal-title">Xoá danh mục</h5>
                <button type="button" class="btn-close" data-bs-toggle="modal"
                    data-bs-target="#deleteConfirmation"></button>
            </div>
            <div class="modal-body">
                Bạn có chắc chắn muốn xoá danh mục này không?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                    data-bs-target="#deleteConfirmation">Đóng</button>
                <button type="button" class="btn btn-danger" onclick="deleteCategory()">Xoá</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        function deleteConfirmation(id) {
            @this.set('category_id', id);
            $('#deleteConfirmation').modal('show');
        }

        function deleteCategory() {
            @this.call('deleteCategory');
            $('#deleteConfirmation').modal('hide');
        }
    </script>
@endpush
