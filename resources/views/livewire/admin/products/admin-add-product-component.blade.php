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
                        <li class="breadcrumb-item"><a href="{{ route('admin.products') }}">Sản phẩm</a></li>
                        <li class="breadcrumb-item active">Thêm sản phẩm</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Thêm sản phẩm</h3>
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
        <form wire:submit.prevent="addProduct">
            <div class="card-body">
                <div class="form-group">
                    <label for="nameCategory">Tên sản phẩm</label>
                    <input type="text" class="form-control" placeholder="Tên sản phẩm" wire:model="name"
                        wire:keyup="generateSlug">
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="slugCategory">Slug</label>
                    <input type="text" class="form-control" placeholder="Slug sản phẩm" wire:model="slug">
                    @error('slug')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="fileInput">Hinh ảnh</label>
                    <div class="custom-file">
                        <input class="pt-2" type="file" id="file-upload" name="file-upload" wire:model="image">
                    </div>
                    @error('image')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    @if ($image)
                        <img src="{{ $image->temporaryUrl() }}" alt="" height="200px">
                    @endif
                </div>

                <div class="form-group">
                    <label for="fileInput">Hinh ảnh group</label>
                    <div class="custom-file">
                        <input class="pt-2" type="file" id="file-upload" name="file-upload" wire:model="images"
                            multiple>
                    </div>
                    @error('images')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    @if ($images)
                        @foreach ($images as $image)
                            <img src="{{ $image->temporaryUrl() }}" alt="" height="200px">
                        @endforeach
                    @endif
                </div>

                <div class="form-group" wire:ignore>
                    <label>Mô tả</label>
                    <textarea class="form-control" name="" id="editordescribe" cols="30" rows="10"
                        wire:model="description"></textarea>
                </div>
                @error('description')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <div class="form-group">
                    <label for="slugCategory">Regular price</label>
                    <input type="text" class="form-control" placeholder="Regular price" wire:model="regular_price">
                    @error('regular_price')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="slugCategory">Giá bán</label>
                    <input type="text" class="form-control" placeholder="Giá bán" wire:model="sale_price">
                    @error('sale_price')
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
                <div class="form-group">
                    <label for="slugCategory">SKU</label>
                    <input type="text" class="form-control" placeholder="SKU" wire:model="SKU">
                    @error('SKU')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="slugCategory">Featured</label>
                    <select class="custom-select" wire:model="featured">
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Danh mục</label>
                            <select class="custom-select" wire:model="category_id">
                                <option value="">Chọn danh mục</option>
                                @foreach ($category as $cate)
                                    <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Danh mục con</label>
                            <select class="custom-select" wire:model="subcategory_id">
                                <option value="">Chọn danh mục</option>
                                @if ($subcategories)
                                    @foreach ($subcategories as $subcategory)
                                        <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('subcategory_id')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Thương hiệu</label>
                    <select class="custom-select" wire:model="brand_id">
                        <option value="">Chọn thương hiệu</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                    @error('brand_id')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="slugCategory">Stock</label>
                    <select class="custom-select" wire:model="stock_status">
                        <option value="instock">InStock</option>
                        <option value="outofstock">Out Of Stock</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="slugCategory">Size</label>
                    <input type="text" class="form-control" placeholder="Size" wire:model="size">
                </div>
                <div class="form-group">
                    <label for="slugCategory">Độ tuổi phù hợp</label>
                    <input type="text" class="form-control" placeholder="Độ tuổi phù hợp"
                        wire:model="suitable_age">
                </div>
                <div class="form-group" wire:ignore>
                    <label>Hướng dẫn sử dụng</label>
                    <textarea class="form-control" name="" id="editoruser_manual" wire:model="user_manual"></textarea>
                </div>
                <div class="form-group" wire:ignore>
                    <label>Hướng dẫn bảo quản</label>
                    <textarea class="form-control" name="" id="editorpreserve" wire:model="preserve"></textarea>
                </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Thêm mới</button>
            </div>
        </form>
    </div>
    <script src="{{ asset('assets/js/ckeditor.js') }}"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editordescribe'))
            .then(function(editor) {
                editor.model.document.on('change:data', () => {
                    @this.set('description', editor.getData())
                })
            })
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#editoruser_manual'))
            .then(function(editor) {
                editor.model.document.on('change:data', () => {
                    @this.set('user_manual', editor.getData())
                })
            })
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#editorpreserve'))
            .then(function(editor) {
                editor.model.document.on('change:data', () => {
                    @this.set('preserve', editor.getData())
                })
            })
            .catch(error => {
                console.error(error);
            });
    </script>
</div>
