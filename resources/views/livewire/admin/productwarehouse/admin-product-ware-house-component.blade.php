<div class="content-wrapper p-2">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý kho</h1>
                </div>
                <div class="col-sm-6">
                    <div class="float-sm-right">
                        <a href="{{ Route('admin.products') }}" class="btn btn-block btn-primary">Xem sản phẩm</a>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <div class="input-group input-group-sm">
                    <select class="form-control">
                        <option>Lọc phiên bản</option>
                    </select>
                </div>
            </h3>

            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
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
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>
                            <div class="icheck-primary m-0">
                                <input type="checkbox" value="" id="check">
                                <label for="check"></label>
                            </div>
                        </th>
                        <th>Sản phẩm</th>
                        <th>Mã SKU</th>
                        <th>Loại sản phẩm</th>
                        <th>Có thể bán</th>
                        <th>Tồn kho</th>
                        <th>Hàng đang về</th>
                        <th>Hàng đang giao</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>
                                <div class="icheck-primary m-0">
                                    <input type="checkbox" value="" id="check{{$product->id}}">
                                    <label for="check{{$product->id}}"></label>
                                </div>
                            </td>
                            <td> <img src="{{ asset('assets/imgs/products') }}/{{ $product->image }}" height="50px"
                                    width="50px" style="object-fit: scale-down;" alt=""> {{ $product->name }}
                            </td>
                            <td>{{ $product->SKU }}</td>
                            <td>{{ $product->subcategory->category->name }}/{{ $product->subcategory->name }}</td>
                            <td>{{ $product->can_sell }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer p-0">
            <div class="mailbox-controls">
                <div class="float-right">
                    {{ $products->links('pagination-links') }}
                </div>
                <!-- /.float-right -->
            </div>
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
