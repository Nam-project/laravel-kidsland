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
                        <li class="breadcrumb-item"><a href="{{ route('admin.coupon') }}">Phiếu giảm giá</a></li>
                        <li class="breadcrumb-item active">Thêm phiếu giảm giá</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Thêm phiếu giảm giá</h3>
        </div>
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
        <form wire:submit.prevent="storeCoupon">
            <div class="card-body">
                <div class="form-group">
                    <label for="nameCategory">Code</label>
                    <input type="text" class="form-control" placeholder="Code" wire:model="code">
                    @error('code')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="nameCategory">Type</label>
                    <select class="custom-select" wire:model="type">
                        <option value="">Select</option>
                        <option value="fixed">VNĐ</option>
                        <option value="percent">%</option>
                    </select>
                    @error('type')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="nameCategory">Cart value</label>
                    <input type="text" class="form-control" placeholder="Cart value" wire:model="cart_value">
                    @error('cart_value')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="slugCategory">Số lượng</label>
                    <input type="text" class="form-control" placeholder="Số lượng" wire:model="quantity">
                    @error('quantity')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Thêm mới</button>
            </div>
        </form>
    </div>
</div>
