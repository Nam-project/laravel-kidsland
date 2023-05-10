<div class="content-wrapper p-2">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.warehouse')}}">Đơn đặt hàng</a></li>
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
</div>
