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
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                class="fas fa-times"></i>
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
                            <td>{{ $order->total }}</td>
                            <td>
                                @if ($order->status == 'delivered')
                                    <span class="badge badge-success">Đã giao hàng</span>
                                @elseif ($order->status == 'canceled')
                                    <span class="badge badge-warning">Hủy bỏ</span>
                                @elseif ($order->status == 'shipping')
                                    <span class="badge badge-info">Đang giao hàng</span>
                                @else
                                    <span class="badge badge-danger">Đang xữ lý</span>
                                @endif
                            </td>
                            <td>{{ $order->created_at }}</td>
                            <td><a class="btn btn-primary btn-sm"
                                    href="{{ route('admin.orderdetails', ['order_id' => $order->id]) }}"><i
                                        class="fas fa-eye"></i></a></td>
                            <td>
                                <button wire:click.prevent='dowloadInvoice({{$order->id}})' class="btn btn-primary btn-sm">
                                    <i class="fas fa-download"></i>
                                </button>
                                {{-- <a href="{{route('admin.invoice',['order_id' => $order->id])}}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-download"></i>
                                </a> --}}
                            </td>
                            <td>
                                @if ($order->status != 'delivered' && $order->status != 'canceled')
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success">Status</button>
                                        <button type="button" class="btn btn-success dropdown-toggle"
                                            data-toggle="dropdown" aria-expanded="false">
                                            {{-- <span class="sr-only">Toggle Dropdown</span> --}}
                                        </button>
                                        <div class="dropdown-menu" role="menu" style="">
                                            <button
                                                wire:click.prevent="updateOrderStatus({{ $order->id }},'delivered')"
                                                class="dropdown-item">Delivered</button>
                                            <button
                                                wire:click.prevent="updateOrderStatus({{ $order->id }},'shipping')"
                                                class="dropdown-item">Shipping</button>
                                            <button
                                                wire:click.prevent="updateOrderStatus({{ $order->id }},'canceled')"
                                                class="dropdown-item">Canceled</button>
                                        </div>
                                    </div>
                                @endif
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
