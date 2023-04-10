<div class="content-wrapper p-2">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Phiếu giảm giá</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Phiếu giảm giá</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="card">
        <div class="card-header">
            <div class="card-tools">
                <a href="{{ route('admin.addcoupon') }}" class="btn btn-block btn-primary">Thêm phiếu giảm giá</a>
            </div>
        </div>
        @if (Session::has('massage'))
            <div class="card bg-success m-1">
                <div class="card-header">
                    <div class="card-title">{{ Session::get('massage') }}</div>
    
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
                        <th>Coupon code</th>
                        <th>Coupon type</th>
                        <th>Coupon value</th>
                        <th>Cart value</th>
                        <th>Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($coupons as $key => $coupon)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $coupon->code }}</td>
                            <td>{{ $coupon->type }}</td>
                            @if ($coupon->type == 'fixed')
                                <td>{{ $coupon->cart_value }} VNĐ</td>
                            @else
                                <td>{{ $coupon->cart_value }} %</td>
                            @endif
                            <td>{{ $coupon->quantity }}</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{route('admin.editcoupon',['coupon_id'=>$coupon->id])}}"><i class="nav-icon fas fa-edit"></i></a>
                                <button class="btn btn-danger btn-sm" wire:click.prevent="deleteCoupon({{$coupon->id}})"><i class="ion-android-delete"></i></button>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

        </div>
        <!-- /.card-body -->
        {{$coupons->links('pagination-links')}}
    </div>
    <!-- /.card -->
</div>
