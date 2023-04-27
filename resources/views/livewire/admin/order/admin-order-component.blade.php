<div class="content-wrapper p-2">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Đơn đặt hàng</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Đơn đặt hàng</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="card">
        {{-- <div class="card-header">
            <div class="card-tools">
                <a href="{{ route('admin.addcoupon') }}" class="btn btn-block btn-primary">Thêm phiếu giảm giá</a>
            </div>
        </div> --}}
        @if (Session::has('order_massage'))
            <div class="card bg-success m-1">
                <div class="card-header">
                    <div class="card-title">{{ Session::get('order_massage') }}</div>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
            </div>
        @endif
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Số ĐT</th>
                        <th>Giảm giá</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Ngày đặt</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $key => $order)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->user->email }}</td>
                            <td>{{ $order->phone }}</td>
                            <td>{{ $order->discount }}</td>
                            <td>{{ $order->total }}</td>
                            <td>{{ $order->status }}</td>
                            <td>{{ $order->created_at }}</td>
                            <td><a class="btn btn-primary btn-sm"
                                    href="{{ route('admin.orderdetails', ['order_id' => $order->id]) }}"><i
                                        class="pr-2 fas fa-folder"></i>Chi tiết</a></td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success">Status</button>
                                    <button type="button" class="btn btn-success dropdown-toggle"
                                        data-toggle="dropdown" aria-expanded="false">
                                        {{-- <span class="sr-only">Toggle Dropdown</span> --}}
                                    </button>
                                    <div class="dropdown-menu" role="menu" style="">
                                        <button wire:click.prevent="updateOrderStatus({{$order->id}},'delivered')" class="dropdown-item">Delivered</button>
                                        <button wire:click.prevent="updateOrderStatus({{$order->id}},'canceled')" class="dropdown-item">Canceled</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

        </div>
        <!-- /.card-body -->
        {{ $orders->links('pagination-links') }}
    </div>
    <!-- /.card -->
</div>
