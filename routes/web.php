<?php

use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\ShopCompoment;
use App\Http\Livewire\CartCompoment;
use App\Http\Livewire\CheckoutCompoment;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\User\UserDashboardCompoment;
use App\Http\Livewire\Admin\AdminDashboardCompoment;
use App\Http\Livewire\Admin\AdminCategoryComponent;
use App\Http\Livewire\Admin\AdminAddCategoryComponent;
use App\Http\Livewire\Admin\AdminEditCategoryComponent;
use App\Http\Livewire\Admin\Subcategory\AdminSubCategoryComponent;
use App\Http\Livewire\Admin\Subcategory\AdminAddSubCategoryComponent;
use App\Http\Livewire\Admin\Subcategory\AdminEditSubCategoryComponent;
use App\Http\Livewire\Admin\Brand\AdminBrandsComponent;
use App\Http\Livewire\Admin\Brand\AdminAddBrandsComponent;
use App\Http\Livewire\Admin\Brand\AdminEditBrandsComponent;
use App\Http\Livewire\Admin\Products\AdminProductComponent;
use App\Http\Livewire\Admin\Products\AdminAddProductComponent;
use App\Http\Livewire\Admin\Products\AdminEditProductComponent;





use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', HomeComponent::class);

Route::get('/shop', ShopCompoment::class);

Route::get('/cart', CartCompoment::class)->name('product.cart');

Route::get('/checkout', CheckoutCompoment::class);

Route::get('/product/{slug}',DetailsComponent::class)->name('product.details');

Route::get('/cart/count', [CartCompoment::class, 'getCartCount']);

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

// for user
Route::middleware(['auth:sanctum', 'verified'])->group(function() {
    Route::get('/user/dashboard', UserDashboardCompoment::class)->name('user.dashboard');
});

// for Admin
Route::middleware(['auth:sanctum', 'verified', 'authadmin'])->group(function() {
    Route::get('/admin/dashboard', AdminDashboardCompoment::class)->name('admin.dashboard');
    // Category
    Route::get('/admin/categories', AdminCategoryComponent::class)->name('admin.categories');
    Route::get('/admin/category/add', AdminAddCategoryComponent::class)->name('admin.addcategory');
    Route::get('/admin/category/edit/{category_slug}', AdminEditCategoryComponent::class)->name('admin.editcategory');
    // Sub category
    Route::get('/admin/subcategory', AdminSubCategoryComponent::class)->name('admin.subcategory');
    Route::get('/admin/subcategory/add', AdminAddSubCategoryComponent::class)->name('admin.addsubcategory');
    Route::get('/admin/subcategory/edit/{subcategory_slug}', AdminEditSubCategoryComponent::class)->name('admin.editsubcategory');
    // Brands
    Route::get('/admin/brands', AdminBrandsComponent::class)->name('admin.brands');
    Route::get('/admin/brands/add', AdminAddBrandsComponent::class)->name('admin.addbrand');
    Route::get('/admin/brands/edit/{brand_id}', AdminEditBrandsComponent::class)->name('admin.editbrand');
    // Products
    Route::get('/admin/products', AdminProductComponent::class)->name('admin.products');
    Route::get('/admin/product/add', AdminAddProductComponent::class)->name('admin.addproduct');
    Route::get('/admin/product/edit/{product_slug}', AdminEditProductComponent::class)->name('admin.editproduct');

});
