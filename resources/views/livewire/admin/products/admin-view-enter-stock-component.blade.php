<div class="content-wrapper p-2">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.receipts') }}">Đơn đặt hàng</a></li>
                        <li class="breadcrumb-item active">Tạo đơn đặt hàng</li>
                    </ol>
                    <h1>Tạo đơn đặt hàng</h1>
                </div>
                <div class="col-sm-6">
                    <div class="">
                        <div class="hh-grayBox pt45 pb20">
                            <div class="row-tracking justify-content-between">
                                <div class="order-tracking completed">
                                    <span class="is-complete"></span>
                                    <p>Đặt hàng</p>
                                </div>
                                <div
                                    class="order-tracking {{ $receipt->status == 'confirm' || $receipt->status == 'complete' ? 'completed' : '' }}">
                                    <span class="is-complete"></span>
                                    <p>Duyệt</p>
                                </div>
                                <div class="order-tracking {{ $receipt->status == 'complete' ? 'completed' : '' }}">
                                    <span class="is-complete"></span>
                                    <p>Nhập kho</p>
                                </div>
                                <div class="order-tracking {{ $receipt->status == 'complete' ? 'completed' : '' }}">
                                    <span class="is-complete"></span>
                                    <p>Hoàn thành</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="card card-primary">
        <!-- /.card-header -->
        <!-- form start -->
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
        @if (Session::has('error'))
            <div class="card bg-danger m-1">
                <div class="card-header">
                    <div class="card-title">{{ Session::get('error') }}</div>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        @endif

    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Thông tin nhà cung cấp</label>
                            <div class="card-header pl-0">
                                <h3 class="card-title">
                                    <i class="fas fa-user"></i>
                                    {{ $receipt->supplier->name }}
                                </h3>
                            </div>
                            <div class="row">
                                <div class="col-md-6 pt-3">
                                    <address class="m-0">
                                        <strong>ĐỊA CHỈ XUẤT HÀNG</strong><br>
                                        {{ $receipt->supplier->name }}<br>
                                        Địa chỉ: {{ $receipt->supplier->address }}<br>
                                        Phone: {{ $receipt->supplier->phone }}<br>
                                        Email: {{ $receipt->supplier->email }}
                                    </address>
                                </div>
                                <div class="col-md-6 pt-3">
                                    <address class="m-0">
                                        <strong>ĐỊA CHỈ XUẤT HÓA ĐƠN</strong><br>
                                        {{ $receipt->supplier->name }}<br>
                                        Địa chỉ: {{ $receipt->supplier->address }}<br>
                                        Phone: {{ $receipt->supplier->phone }}<br>
                                        Email: {{ $receipt->supplier->email }}
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-default">
                    <div class="card-header">
                        <div class="form-group">
                            <label for="">Thông tin sản phẩm</label>

                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Mã SKU</th>
                                    <th>Hình ảnh</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Gía nhập</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($receipt->detailReceipt as $item)
                                    <tr>
                                        <td>{{ $item->product->SKU }}</td>
                                        <td>
                                            <img class="img__receipt"
                                                src="{{ asset('assets/imgs/products') }}/{{ $item->product->image }}"
                                                alt="">
                                        </td>
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ number_format($item->price, 0) }}</td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="card-footer p-0">
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item float-right pl-3 pr-3">
                                    <b>Tổng tiền:</b>
                                    <p class="float-right">{{ number_format($receipt->total, 0) }}</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <i class="fas fa-money-check"></i>
                            <label for="">Thanh toán</label>
                        </div>
                        <!-- select -->
                        <div class="card-footer p-0">
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item float-right pl-3 pr-3">
                                    <p class="float-left">Đã thanh toán</p>
                                    <p class="float-right">{{ number_format($receipt->total, 0) }} đ</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body pb-0">
                        @if ($receipt->status == 'complete')
                            <div class="form-group">
                                <i class="fas fa-truck-moving"></i>
                                <label for="">Nhập kho</label>
                            </div>
                            <div class="timeline m-0">
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <div>
                                    <i class="fas fa-check bg-blue"></i>
                                    <div class="timeline-item">
                                        <div class="timeline-header">PC000{{ $receipt->id }}
                                        </div>
                                        <div class="timeline-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <strong for="">Mã phiếu nhập kho</strong>
                                                    <p for="">PC000{{ $receipt->id }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Tổng tiền</label>
                                                    <p for="">{{ number_format($receipt->total, 0) }} đ</p>
                                                </div>
                                            </div>
                                            <div>
                                                <strong for="">Ngày nhập kho</strong>
                                                <p>{{ $receipt->updated_at }}</p>
                                            </div>
                                        </div>
                                        <div class="timeline-footer">
                                            <strong for="">Sản phẩm</strong>
                                            @foreach ($receipt->detailReceipt as $item)
                                            <p>
                                                {{ $item->quantity }} x
                                                {{ $item->product->name }}
                                            </p>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <!-- END timeline item -->
                                <!-- timeline item -->
                            </div>
                        @else
                            <div class="form-group">
                                <i class="fas fa-truck-moving"></i>
                                <label for="">Nhập kho</label>
                                <button wire:click.prevent="importWareHouse" class="btn btn-primary float-right">Nhập
                                    kho</button>
                            </div>
                        @endif
                    </div>
                </div>
                @if ($receipt->status == 'confirm')
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <i class="fas fa-exchange-alt"></i>
                            <label for="">Hoàn trả</label>
                            <button type="submit" class="btn btn-default float-right">Hoàn trả</button>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <label for="">Thông tin đơn hàng</label>
                        <div class="form-group">
                            <div class="card-header pl-0">
                                <h3 class="card-title">
                                    <i class="nav-icon fas fa-book"></i>
                                    {{ $receipt->warehouse->name }}
                                </h3>
                            </div>
                            <address class="m-0">
                                <strong>ĐỊA CHỈ KHO HÀNG</strong><br>
                                {{ $receipt->warehouse->name }}<br>
                                Địa chỉ: {{ $receipt->warehouse->address }}<br>
                                Phone: {{ $receipt->warehouse->phone }}<br>
                            </address>
                        </div>
                        <div class="form-group">
                            <label class="title__receipts" for="">Ghi chú</label>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="card-body">
            <button type="submit" class="btn btn-primary float-right">Đặt hàng và duyệt</button>
        </div> --}}
    </div>
</div>
