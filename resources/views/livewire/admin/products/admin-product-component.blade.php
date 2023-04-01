<div class="content-wrapper p-2">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sản phẩm</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Sản phẩm</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="card">
        <div class="card-header">
            <div class="card-tools">
                <a href="" class="btn btn-block btn-primary">Thêm sản phẩm</a>
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
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Stock</th>
                        <th>Giá</th>
                        <th>Thuộc danh mục</th>
                        <th>Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $key => $product)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td><img src="{{asset('assets/imgs/products')}}/{{$product->image}}" height="100px" alt=""></td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->stock_status }}</td>
                            <td>{{ }}</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href=""><i class="nav-icon fas fa-edit"></i></a>
                                <button class="btn btn-danger btn-sm" wire:click.prevent=""><i class="ion-android-delete"></i></button>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

        </div>
        <!-- /.card-body -->
        {{-- <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-right">
                <li class="page-item"><a class="page-link" href="{{ $brands->previousPageUrl() }}">&laquo;</a></li>
                @for ($i = 1; $i <= $brands->lastPage(); $i++)
                    <!-- a Tag for another page -->
                    <li class="page-item"><a class="page-link" href="{{ $brands->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
                <li class="page-item"><a class="page-link" href="{{ $brands->nextPageUrl() }}">&raquo;</a></li>
            </ul>
        </div> --}}
    </div>
    <!-- /.card -->
</div>
