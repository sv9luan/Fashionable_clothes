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
                    <span></span> Slider
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
                                        Tất cả slider
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('admin.home.slide.add') }}"
                                            class="btn btn-success float-end">Thêm slider</a>
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
                                                <th>TopTitle</th>
                                                <th>SubTitle</th>
                                                <th>Offer</th>
                                                <th>Link</th>
                                                <th>Trạng thái</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 0;
                                            @endphp
                                            @foreach ($sliders as $slide)
                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    <td><img src="{{ asset('assets/imgs/slides') }}/{{ $slide->image }}"
                                                            width="80"> </td>
                                                    <td>{{ $slide->top_title }}</td>
                                                    <td>{{ $slide->title }}</td>
                                                    <td>{{ $slide->sub_title }}</td>
                                                    <td>{{ $slide->offer }}</td>
                                                    <td>{{ $slide->link }}</td>
                                                    <td>{{ $slide->status == 1 ? 'Active' : 'Inactive' }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.home.slide.edit', ['slide_id' => $slide->id]) }}"
                                                            class="text-info">Sửa
                                                        </a>
                                                        <a href="#" class="text-danger"
                                                            onclick="deleteConfirmation({{ $slide->id }})"
                                                            style="margin-left: 20px">Xoá
                                                        </a>

                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
                <h5 class="modal-title">Xoá slider</h5>
                <button type="button" class="btn-close" data-bs-toggle="modal"
                    data-bs-target="#deleteConfirmation"></button>
            </div>
            <div class="modal-body">
                Bạn có chắc chắn muốn xoá slider này không?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                    data-bs-target="#deleteConfirmation">Đóng</button>
                <button type="button" class="btn btn-danger" onclick="deleteSlide()">Xoá</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        function deleteConfirmation(id) {
            @this.set('slide_id', id);
            $('#deleteConfirmation').modal('show');
        }

        function deleteSlide() {
            @this.call('deleteSlide');
            $('#deleteConfirmation').modal('hide');
        }
    </script>
@endpush
