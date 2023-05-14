<div class="content-wrapper p-2">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Đơn nhập hàng</h1>
                </div>
                <div class="col-sm-6">
                    <div class="float-sm-right">
                        <a href="{{ Route('admin.addreceipts') }}" class="btn btn-block btn-primary">Tạo đơn nhập hàng</a>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="card">
        @if (session()->has('message'))
            <div class="card bg-success">
                <div class="card-header">
                    <h3 class="card-title">{{ session('message') }}</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                class="fas fa-times"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
            </div>
        @endif
        @if (Session::has('massage'))
            <div class="card bg-success m-1">
                <div class="card-header">
                    <div class="card-title">{{ Session::get('massage') }}</div>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        @endif
        <!-- /.card-header -->
        <div class="card-body">
            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                <li class="nav-item">
                    <a class="btn nav-link {{$sorting == 'all' ? 'active' : ''}}" wire:click="sortingReceipt('all')" id="custom-content-below-home-tab"
                        role="tab">Tất cả đơn nhập hàng</a>
                </li>
                <li class="nav-item">
                    <a class="btn nav-link {{$sorting == 'all' ? '' : 'active'}}" wire:click="sortingReceipt('confirm')" id="custom-content-below-profile-tab"
                        role="tab">Đang giao dịch</a>
                </li>
            </ul>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên nhà cung cấp</th>
                        <th>Chi nhánh</th>
                        <th>Trạng thái</th>
                        <th>Thanh toán</th>
                        <th>Nhập kho</th>
                        <th>Tổng tiền</th>
                        <th>Nhân viên tạo</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($receipts as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->supplier->name }}</td>
                            <td>{{ $item->warehouse->name }}</td>
                            <td>
                                @if ($item->status == 'complete')
                                    <small class="badge badge-success">Hoàn thành</small>
                                @else
                                    <small class="badge badge-info">Duyệt</small>
                                @endif
                            </td>
                            <td>
                                <small class="badge badge-success">Đã thanh toán</small>
                            </td>
                            <td>
                                @if ($item->status == 'complete')
                                    <small class="badge badge-success">Đã nhập kho</small>
                                @else
                                    <small class="badge badge-info">Chưa nhập kho</small>
                                @endif
                            </td>
                            <td>{{ $item->total }}</td>
                            <td>
                                {{ $item->user->name }}
                            </td>
                            <td>
                                <a href="{{ Route('admin.viewreceipts', ['receipt_id' => $item->id]) }}"
                                    class="btn btn-primary btn-sm">
                                    <i class="fas fa-eye"></i>
                                    </i>
                                    View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <!-- /.card-body -->
        {{-- <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-right">
                <li class="page-item"><a class="page-link" href="{{ $products->previousPageUrl() }}">&laquo;</a></li>
                @for ($i = 1; $i <= $products->lastPage(); $i++)
                    <!-- a Tag for another page -->
                    <li class="page-item"><a class="page-link" href="{{ $products->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
                <li class="page-item"><a class="page-link" href="{{ $products->nextPageUrl() }}">&raquo;</a></li>
            </ul>
        </div> --}}
    </div>
    <!-- /.card -->
</div>
