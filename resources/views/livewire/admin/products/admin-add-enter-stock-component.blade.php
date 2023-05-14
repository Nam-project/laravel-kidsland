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
                                <div class="order-tracking ">
                                    <span class="is-complete"></span>
                                    <p>Duyệt</p>
                                </div>
                                <div class="order-tracking ">
                                    <span class="is-complete"></span>
                                    <p>Nhập kho</p>
                                </div>
                                <div class="order-tracking ">
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
        <form action="" wire:submit.prevent="storeReceipt">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Thông tin nhà cung cấp</label>
                                @if ($supplier_id)
                                    <div class="card-header pl-0">
                                        <h3 class="card-title">
                                            <i class="fas fa-user"></i>
                                            {{ $supplier->name }}
                                        </h3>
                                        <button type="button" wire:click.prevent="resetSupplierId"
                                            class="btn btn-outline-danger btn-sm float-right">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </div>
                                @else
                                    <select class="form-control" wire:model="supplier_id">
                                        <option>Chọn nhà cung cấp</option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('supplier_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                @endif
                                @if ($supplier_id)
                                    <div class="row">
                                        <div class="col-md-6 pt-3">
                                            <address class="m-0">
                                                <strong>ĐỊA CHỈ XUẤT HÀNG</strong><br>
                                                {{ $supplier->name }}<br>
                                                Địa chỉ: {{ $supplier->address }}<br>
                                                Phone: {{ $supplier->phone }}<br>
                                                Email: {{ $supplier->email }}
                                            </address>
                                        </div>
                                        <div class="col-md-6 pt-3">
                                            <address class="m-0">
                                                <strong>ĐỊA CHỈ XUẤT HÓA ĐƠN</strong><br>
                                                {{ $supplier->name }}<br>
                                                Địa chỉ: {{ $supplier->address }}<br>
                                                Phone: {{ $supplier->phone }}<br>
                                                Email: {{ $supplier->email }}
                                            </address>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card card-default">
                        <div class="card-header">
                            <div class="form-group">
                                <label for="">Thông tin sản phẩm</label>
                                <div class="input-group mb-3">
                                    <input type="text" placeholder="Tìm kiếm sản phẩm" wire:model="product"
                                        class="receipts__position form-control">
                                    @if ($product)
                                        <div class="receipts__products">
                                            @foreach ($products as $item)
                                                <a wire:click.prevent="storeProductReceipt({{ $item->id }},'{{ $item->name }}','{{ $item->regular_price }}')"
                                                    class="btn-default btn-block">
                                                    <div class="row">
                                                        <div class="col-md-1">
                                                            <img src="{{ asset('assets/imgs/products') }}/{{ $item->image }}"
                                                                class="pr-1" height="60px" alt="">
                                                        </div>
                                                        <div class="col-md-9">
                                                            <h6>{{ $item->name }}</h6>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <p>{{ $item->regular_price }} đ</p>
                                                            <h6>Số lượng: {{ $item->quantity }}</h6>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif
                                    <div class="input-group-append">
                                        <input type="checkbox" class="supplier_ckeck" wire:model="show_products"
                                            value="1" name="show_supplier" id="show_products">
                                        <label for="show_products" class="input-group-text btn btn-default">Chọn</label>
                                        @if ($show_products == 1)
                                            <label for="show_products" class="supplier-cushion"></label>
                                            <div class="form-supplier">
                                                <div>
                                                    <div class="card-header">
                                                        <h3 class="card-title">Sản phẩm</h3>

                                                        <div class="card-tools">
                                                            <label for="show_products" class="btn btn-tool">
                                                                <i class="fas fa-times"></i>
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="cart-body p-2">
                                                        @foreach ($list_products as $item)
                                                            <a wire:click.prevent="storeProductReceipt({{ $item->id }},'{{ $item->name }}','{{ $item->regular_price }}')"
                                                                class="item__product">
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <img src="{{ asset('assets/imgs/products') }}/{{ $item->image }}"
                                                                            class="pr-1" height="60px"
                                                                            width="60px"
                                                                            style="object-fit: scale-down;"
                                                                            alt="">
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <h6>{{ $item->name }}</h6>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <p>{{ $item->regular_price }} đ</p>
                                                                        <h6>Số lượng: {{ $item->quantity }}</h6>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                    <!-- /.card-header -->
                                                    <!-- form start -->
                                                    <div class="card-footer">
                                                        <label for="show_products" type="submit"
                                                            class="btn btn-default">Thoát</label>
                                                        <div class="float-right">
                                                            {{ $list_products->links('pagination-links') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            @if (count($receipt) > 0)
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
                                        @foreach ($receipt as $item)
                                            <tr>
                                                <td>{{ $item->model->SKU }}</td>
                                                <td><img class="img__receipt"
                                                        src="{{ asset('assets/imgs/products') }}/{{ $item->model->image }}"
                                                        alt=""></td>
                                                <td>{{ $item->name }}</td>
                                                <td>
                                                    <div class="input-group input-group-sm">
                                                        <input type="number" class="form-control"
                                                            wire:model="qty.{{ $item->rowId }}"
                                                            wire:keyup="updateReceipt('{{ $item->rowId }}')">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group input-group-sm">
                                                        <input class="form-control" type="number"
                                                            wire:model="price.{{ $item->rowId }}"
                                                            wire:keyup="updatePrice('{{ $item->rowId }}')">
                                                    </div>
                                                </td>
                                                <td>
                                                    <button type="button"
                                                        wire:click.prevent="destroyReceipt('{{ $item->rowId }}')"
                                                        class="btn btn-outline-danger btn-sm" fdprocessedid="clt2vt">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="card-footer p-0">
                                    <ul class="list-group list-group-unbordered">
                                        <li class="list-group-item float-right pl-3 pr-3">
                                            <b>Số lượng:</b>
                                            <p class="float-right">{{ $totalQuantity }}</p>
                                        </li>
                                        <li class="list-group-item float-right pl-3 pr-3">
                                            <b>Tổng tiền:</b>
                                            <p class="float-right">{{ Cart::instance('receipt')->subtotal() }}</p>
                                        </li>
                                    </ul>
                                </div>
                            @else
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <img class="profile-user-img img-fluid img-circle"
                                            src="{{ asset('assets/imgs/icon/rejected.png') }}"
                                            alt="User profile picture">
                                    </div>
                                    <p class="text-muted text-center pt-2">Đơn nhập của bạn chưa có sản phẩm nào</p>
                                    <div class="text-center">
                                        <label for="show_products" class="btn btn-default"><b class="text-muted">Thêm
                                                sản phẩm
                                                ngay</b></label>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <i class="fas fa-money-check"></i>
                                        <label for="">Thanh toán</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-check float-right">
                                            <input class="form-check-input" type="checkbox" id="check_payment"
                                                value="1" wire:model="check_payment">
                                            <label for="check_payment" class="form-check-label text-muted">Thanh toán
                                                với nhà cung cấp</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($check_payment == 1)
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- select -->
                                        <div class="form-group">
                                            <p>Hình thức thanh toán</p>
                                            <select class="form-control">
                                                <option selected>Tiền mặt</option>
                                                <option>Chuyển khoản</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <p>Số tiền thanh toán</p>
                                            <input type="text" class="form-control"
                                                value="{{ Cart::instance('receipt')->subtotal() }}" id=""
                                                placeholder="Enter email">
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    {{-- <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <i class="fas fa-truck-moving"></i>
                                <label for="">Nhập kho</label>
                                <button type="submit" class="btn btn-primary float-right">Nhập kho</button>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <i class="fas fa-exchange-alt"></i>
                                <label for="">Hoàn trả</label>
                                <button type="submit" class="btn btn-primary float-right">Hoàn trả</button>
                            </div>
                        </div>
                    </div> --}}
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <label for="">Thông tin đơn hàng</label>
                            <div class="form-group">
                                @if ($warehouse_id)
                                    <div class="card-header pl-0">
                                        <h3 class="card-title">
                                            <i class="nav-icon fas fa-book"></i>
                                            {{ $warehouse->name }}
                                        </h3>
                                        <button type="button" wire:click.prevent="resetWareHouseId"
                                            class="btn btn-outline-danger btn-sm float-right">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </div>
                                    <address class="m-0">
                                        <strong>ĐỊA CHỈ KHO HÀNG</strong><br>
                                        {{ $warehouse->name }}<br>
                                        Địa chỉ: {{ $warehouse->address }}<br>
                                        Phone: {{ $warehouse->phone }}<br>
                                    </address>
                                @else
                                    <label class="title__receipts" for="">Kho hàng</label>

                                    <select class="form-control" wire:model="warehouse_id">
                                        <option selected>Chọn nhà cung cấp</option>
                                        @foreach ($warehouses as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('warehouse_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="title__receipts" for="">Ghi chú</label>
                                <textarea class="form-control" wire:model="note" name="" id="" rows="6"></textarea>
                                @error('note')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <button type="submit" class="btn btn-primary float-right">Đặt hàng và duyệt</button>
            </div>
        </form>
    </div>
</div>
