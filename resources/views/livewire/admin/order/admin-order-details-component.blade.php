<div class="content-wrapper p-2">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chi tiết đơn hàng</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.order') }}">Đơn đặt hàng</a></li>
                        <li class="breadcrumb-item active">Chi tiết đơn đặt hàng</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Order Details</h3>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <tr>
                    <th>Ngày đặt:</th>
                    <td>{{ $order->created_at }}</td>
                    <th>Trạng thái:</th>
                    <td>
                        @if ($order->status == 'delivered')
                            <span class="badge badge-success">Đã giao hàng</span>
                        @elseif ($order->status == 'canceled')
                            <span class="badge badge-warning">Hủy bỏ</span>
                        @else
                            <span class="badge badge-danger">Đang xữ lý</span>
                        @endif
                    </td>
                    <th>
                        @if ($order->status == 'delivered')
                            Ngày giao:
                        @elseif ($order->status == 'canceled')
                            Ngày hủy bỏ
                        @endif
                    </th>
                    <td>
                        @if ($order->status == 'delivered')
                            {{$order->delivered_date}}
                        @elseif ($order->status == 'canceled')
                            {{$order->canceled_date}}
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Order Items</h3>
        </div>
        <div class="card-body">
            <ul class="products-list product-list-in-card">
                @foreach ($order->detailOrder as $item)
                    <li class="item">
                        <div class="product-img">
                            <img src="{{ asset('assets/imgs/products/' . $item->product->image) }}"
                                alt="{{ $item->product->name }}" class="img-size-50">
                        </div>
                        <div class="product-info">
                            <a href="{{ route('product.details', ['slug' => $item->product->slug]) }}"
                                class="product-title">{{ $item->product->name }}
                                <span class="badge badge-info float-right">{{ $item->price * $item->count }}
                                    VNĐ</span></a>
                            <span class="product-description">
                                <span>Số lượng:
                                    {{ $item->count }}</span>
                                <span class="pl-5">Giá:
                                    {{ $item->price }} VNĐ</span>
                            </span>
                        </div>
                    </li>
                @endforeach
            </ul>
            <div class="table-responsive">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th>Tổng cộng:</th>
                            <td class="float-right">{{ $order->total + $order->discount }} VNĐ</td>
                        </tr>
                        <tr>
                            <th>Tiền giảm:</th>
                            <td class="float-right">{{ $order->discount }} VNĐ</td>
                        </tr>
                        <tr>
                            <th>Tổng thanh toán:</th>
                            <td class="float-right">{{ $order->total }} VNĐ</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Billing Details</h3>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <tr>
                    <th>Tên:</th>
                    <td>{{ $order->name }}</td>
                    <th>Địa chỉ:</th>
                    <td>{{ $order->ward->province->city->name }} / {{ $order->ward->province->name }} /
                        {{ $order->ward->name }}</td>
                </tr>
                <tr>
                    <th>Địa chỉ cụ thể:</th>
                    <td>{{ $order->address }}</td>
                    <th>Số Điện thoại:</th>
                    <td>{{ $order->phone }}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Transaction</h3>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <tr>
                    <th>Mode:</th>
                    <td>{{ $order->transaction->mode }}</td>
                </tr>
                <tr>
                    <th>Trạng thái:</th>
                    <td>{{ $order->transaction->status }}</td>
                </tr>
                <tr>
                    <th>Ngày đặt:</th>
                    <td>{{ $order->transaction->created_at }}</td>
                </tr>
            </table>
        </div>
    </div>
    <!-- /.card -->
</div>
