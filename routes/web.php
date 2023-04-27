<?php

use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\ShopCompoment;
use App\Http\Livewire\CartCompoment;
use App\Http\Livewire\SearchComponent;
use App\Http\Livewire\CheckoutCompoment;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\ThankYouComponent;
use App\Http\Livewire\User\UserDashboardCompoment;
use App\Http\Livewire\User\UserOrdersComponent;
use App\Http\Livewire\User\UserOrderDetailsComponent;
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
use App\Http\Livewire\Admin\Slider\AdminHomeSliderComponent;
use App\Http\Livewire\Admin\Slider\AdminAddHomeSliderComponent;
use App\Http\Livewire\Admin\Slider\AdminEditHomeSliderComponent;
use App\Http\Livewire\Admin\Weightage\AdminWeightAgeComponent;
use App\Http\Livewire\Admin\Weightage\AdminAddWeightAgeComponent;
use App\Http\Livewire\Admin\Weightage\AdminEditWeightAgeComponent;
use App\Http\Livewire\Admin\Coupon\AdminCouponComponent;
use App\Http\Livewire\Admin\Coupon\AdminAddCouponComponent;
use App\Http\Livewire\Admin\Coupon\AdminEditCouponComponent;
use App\Http\Livewire\Admin\Order\AdminOrderComponent;
use App\Http\Livewire\Admin\Order\AdminOrderDetailsComponent;

use App\Http\Controllers\VnPayController;



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

Route::get('/checkout', CheckoutCompoment::class)->name('checkout');

Route::get('/product/{slug}',DetailsComponent::class)->name('product.details');

Route::get('/product-category/{category_slug}/{subcategory_slug?}', CategoryComponent::class)->name('product.category');

Route::get('/cart/count', [CartCompoment::class, 'getCartCount']);

Route::get('/search',SearchComponent::class)->name('product.search');

Route::get('/thank-you', ThankYouComponent::class)->name('thankyou');


// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

// for user
Route::middleware(['auth:sanctum', 'verified'])->group(function() {
    Route::get('/user/dashboard', UserDashboardCompoment::class)->name('user.dashboard');
    // Route::post('/callback', CheckoutCompoment::class . '@callback')->name('callback');
    Route::get('/user/orders', UserOrdersComponent::class)->name('user.orders');
    Route::get('/user/orders/{order_id}', UserOrderDetailsComponent::class)->name('user.orderdetails');
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

    // Home Slider
    Route::get('/admin/slider', AdminHomeSliderComponent::class)->name('admin.homeslider');
    Route::get('/admin/slider/add', AdminAddHomeSliderComponent::class)->name('admin.addhomeslider');
    Route::get('/admin/slider/edit/{slider_id}', AdminEditHomeSliderComponent::class)->name('admin.edithomeslider');

    // WeightAge
    Route::get('/admin/weightage', AdminWeightAgeComponent::class)->name('admin.weightage');
    Route::get('/admin/weightage/add', AdminAddWeightAgeComponent::class)->name('admin.addweightage');
    Route::get('/admin/weightage/edit/{weightage_id}', AdminEditWeightAgeComponent::class)->name('admin.editweightage');

    // WeightAge
    Route::get('/admin/coupon', AdminCouponComponent::class)->name('admin.coupon');
    Route::get('/admin/coupon/add', AdminAddCouponComponent::class)->name('admin.addcoupon');
    Route::get('/admin/coupon/edit/{coupon_id}', AdminEditCouponComponent::class)->name('admin.editcoupon');

    // Order
    Route::get('/admin/orders', AdminOrderComponent::class)->name('admin.order');
    Route::get('/admin/orders/{order_id}', AdminOrderDetailsComponent::class)->name('admin.orderdetails');
});
