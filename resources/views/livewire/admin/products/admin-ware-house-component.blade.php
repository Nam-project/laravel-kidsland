<div class="content-wrapper p-2">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý chi nhánh</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Quản lý chi nhánh</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="card">
        <div class="card-header">
            <div class="card-tools">
                <input type="checkbox" class="supplier_ckeck" wire:model="showwarehouse" value="1"
                    name="showwarehouse" id="showwarehouse">
                <label for="showwarehouse" class="btn btn-block btn-primary">Thêm chi nhánh</label>
            </div>
            @if ($showwarehouse == 1)
                <label for="showwarehouse" class="supplier-cushion"></label>
                <div class="form-supplier">
                    <div>
                        <div class="card-header">
                            <h3 class="card-title">Thêm mới chi nhánh</h3>

                            <div class="card-tools">
                                <label for="showwarehouse" class="btn btn-tool">
                                    <i class="fas fa-times"></i>
                                </label>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form wire:submit.prevent="addWarehouse" class="form-horizontal">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên chi nhánh</label>
                                    <input type="text" class="form-control" wire:model="name" placeholder="">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Địa chỉ</label>
                                    <input type="text" class="form-control" wire:model="address" placeholder="">
                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số điện thoại</label>
                                    <input type="text" class="form-control" wire:model="phone" placeholder="">
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <select class="form-control" wire:model='city_id'>
                                            <option value="" selected>Chọn thành phố</option>
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->matp }}">{{ $city->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <select class="form-control" wire:model='province_id'>
                                            <option value="" selected>Chọn quận huyện</option>
                                            @if ($city_id)
                                                @foreach ($provinces as $province)
                                                    <option value="{{ $province->maqh }}">{{ $province->name }}</option>
                                                @endforeach
                                            @else
                                                <option value="">Vui lòng chọn thành phố</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <select class="form-control" wire:model="ward_id">
                                            <option value="" selected>Chọn xã phường</option>
                                            @if ($province_id)
                                                @foreach ($wards as $ward)
                                                    <option value="{{ $ward->xaid }}">{{ $ward->name }}</option>
                                                @endforeach
                                            @else
                                                <option value="">Vui lòng chọn quận huyện</option>
                                            @endif
                                        </select>
                                        @error('ward_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <label for="showwarehouse" type="submit" class="btn btn-default">Thoát</label>
                                <button type="submit" class="btn btn-info float-right">Thêm</button>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                </div>
            @endif
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
        <div class="card-body">
            <table class="table table-striped table-valign-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên chi nhánh</th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Thành phố/Tỉnh</th>
                        <th>Quận/Huyện</th>
                        <th>Xã Phường</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($warehouses as $key => $item)
                        <tr>
                            <td>
                                {{ $key + 1 }}
                            </td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->address }}</td>
                            <td>{{ $item->ward->province->city->name }}</td>
                            <td>{{ $item->ward->province->name }}</td>
                            <td>{{ $item->ward->name }}</td>
                            <td>
                                <button wire:click="valueEdit({{ $item->id }})" class="btn btn-primary btn-sm"><i
                                        class="nav-icon fas fa-edit"></i></button>
                                @if ($itemId != 0)
                                    <label wire:click="resetValueEdit" class="supplier-cushion"></label>
                                    <div class="form-supplier">
                                        <div>
                                            <div class="card-header">
                                                <h3 class="card-title">Chỉnh sửa chi nhánh</h3>

                                                <div class="card-tools">
                                                    <label wire:click="resetValueEdit" class="btn btn-tool">
                                                        <i class="fas fa-times"></i>
                                                    </label>
                                                </div>
                                            </div>
                                            <!-- /.card-header -->
                                            <!-- form start -->
                                            <form wire:submit.prevent="updateWareHouse({{$itemId}})"
                                                class="form-horizontal">
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Tên chi nhánh</label>
                                                        <input wire:ignore type="text" class="form-control"
                                                            wire:model="name" placeholder="">
                                                        @error('name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Địa chỉ</label>
                                                        <input type="text" class="form-control"
                                                            wire:model="address" placeholder="">
                                                        @error('address')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Số điện thoại</label>
                                                        <input type="text" class="form-control" wire:model="phone"
                                                            placeholder="">
                                                        @error('phone')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <select class="form-control" wire:model='city_id'>
                                                                <option value="" selected>Chọn thành phố</option>
                                                                @foreach ($cities as $city)
                                                                    <option value="{{ $city->matp }}">
                                                                        {{ $city->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-4">
                                                            <select class="form-control" wire:model='province_id'>
                                                                <option value="" selected>Chọn quận huyện
                                                                </option>
                                                                @if ($city_id)
                                                                    @foreach ($provinces as $province)
                                                                        <option value="{{ $province->maqh }}">
                                                                            {{ $province->name }}</option>
                                                                    @endforeach
                                                                @else
                                                                    <option value="">Vui lòng chọn thành phố
                                                                    </option>
                                                                @endif
                                                            </select>
                                                        </div>
                                                        <div class="col-4">
                                                            <select class="form-control" wire:model="ward_id">
                                                                <option value="" selected>Chọn xã phường</option>
                                                                @if ($province_id)
                                                                    @foreach ($wards as $ward)
                                                                        <option value="{{ $ward->xaid }}">
                                                                            {{ $ward->name }}</option>
                                                                    @endforeach
                                                                @else
                                                                    <option value="">Vui lòng chọn quận huyện
                                                                    </option>
                                                                @endif
                                                            </select>
                                                            @error('ward_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.card-body -->
                                                <div class="card-footer">
                                                    <label wire:click="resetValueEdit"
                                                        class="btn btn-default">Thoát</label>
                                                    <button type="submit" class="btn btn-info float-right">Cập
                                                        nhật</button>
                                                </div>
                                                <!-- /.card-footer -->
                                            </form>
                                        </div>
                                    </div>
                                @endif
                                <button class="btn btn-danger btn-sm"
                                    wire:click.prevent="deleteWarehouse({{ $item->id }})"><i
                                        class="ion-android-delete"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

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
        {{ $warehouses->links('pagination-links') }}
    </div>
    <!-- /.card -->
</div>
