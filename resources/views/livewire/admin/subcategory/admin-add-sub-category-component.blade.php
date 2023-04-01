<div class="content-wrapper p-2">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Danh mục con</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.categories') }}">Danh mục</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.subcategory') }}">Danh mục con</a></li>
                        <li class="breadcrumb-item active">Thêm danh mục con</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Thêm danh mục con</h3>
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
        <form wire:submit.prevent="storeSubCategory">
            <div class="card-body">
                <div class="form-group">
                    <label for="nameCategory">Tên danh mục con</label>
                    <input type="text" class="form-control" placeholder="Tên danh mục" wire:model="name"
                        wire:keyup="generateSlug">
                </div>
                <div class="form-group">
                    <label for="slugCategory">Slug</label>
                    <input type="text" class="form-control" placeholder="Slug danh mục" wire:model="slug">
                </div>
                <div class="form-group">
                    <label>Danh mục</label>
                    <select class="custom-select" wire:model="category_id">
                        <option value="">Chọn danh mục</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Thêm mới</button>
            </div>
        </form>
    </div>
</div>
