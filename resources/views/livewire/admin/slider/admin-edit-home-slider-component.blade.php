<div class="content-wrapper p-2">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Slider</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.homeslider') }}">Slider</a></li>
                        <li class="breadcrumb-item active">Chỉnh sửa Slider</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Chỉnh sửa Slider</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
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
        <form wire:submit.prevent="updateSlider">
            <div class="card-body">
                <div class="form-group">
                    <label for="nameCategory">Link</label>
                    <input type="text" class="form-control" placeholder="Link" wire:model="link">
                </div>
                <div class="form-group">
                    <label for="slugCategory">Status</label>
                    <select name="" id="" class="form-control" wire:model="status">
                        <option value="0">Inactive</option>
                        <option value="1">Active</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="fileInput">Hinh ảnh</label>
                    <div class="custom-file">
                        <input class="pt-2" type="file" id="file-upload" name="file-upload" wire:model="newimage">
                    </div>
                </div>
                @if($newimage)
                    <img src="{{ $newimage->temporaryUrl() }}" alt="" height="200px">
                @else
                    <img src="{{ asset('assets/imgs/sliders') }}/{{$image}}" alt="" height="200px">
                @endif
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </div>
        </form>
    </div>
</div>
