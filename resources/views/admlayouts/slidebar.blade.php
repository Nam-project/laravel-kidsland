<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{route('admin.dashboard')}}" class="brand-link">
    <img src="{{asset('assets/imgs/2.png')}}" alt="Admin Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Admin KidsLand</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
             {{-- active --}}
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Danh mục
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('admin.categories')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Liệt kê danh mục</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('admin.addcategory')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Thêm danh mục</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="ion-android-list"></i>
                <p>
                  Danh mục con
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                  <a href="{{route('admin.subcategory')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Liệt kê danh mục con</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('admin.addsubcategory')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Thêm danh mục con</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="ion-android-list"></i>
                <p>
                  Cân nặng và tuổi
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                  <a href="{{route('admin.weightage')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Liệt kê Cân nặng và tuổi</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('admin.addweightage')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Thêm Cân nặng và tuổi</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Thương hiệu
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('admin.brands')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Liệt kê thương hiệu</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('admin.addbrand')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Thêm thương hiệu</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-table"></i>
            <p>
              Sản phẩm
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('admin.products')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Liệt kê sản phẩm</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('admin.addproduct')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Thêm sản phẩm</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('admin.warehouse')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Nhập hàng</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('admin.supplier')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Nhà cung cấp</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon far fa-image"></i>
            <p>
              Slider
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('admin.homeslider')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Liệt kê Slider</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('admin.addhomeslider')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Thêm Slider</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-columns"></i>
            <p>
              Phiếu giảm giá
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('admin.coupon')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Liệt kê phiếu giảm giá</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('admin.addcoupon')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Thêm phiếu giảm giá</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="{{route('admin.order')}}" class="nav-link">
            <i class="pl-1 fas fa-inbox"></i>
            <p>
              Đơn đặt hàng
            </p>
          </a>
        </li>
        
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>