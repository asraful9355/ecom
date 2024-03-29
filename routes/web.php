<?php

use App\Http\Controllers\backend\BackendController;
use App\Http\Controllers\backend\BrandController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\CouponController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\ProfileController;
use App\Http\Controllers\backend\ShippingAreaController;
use App\Http\Controllers\backend\SliderController;
use App\Http\Controllers\backend\SubCategoryController;
use App\Http\Controllers\backend\SubSubCategoryController;
use App\Http\Controllers\backendAdminController;
use App\Http\Controllers\frontend\AddToCartController;
use App\Http\Controllers\frontend\FrontendController;
use App\Http\Controllers\frontend\IndexController;
use App\Http\Controllers\frontend\LanguageController;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\user\CartPageController;
use App\Http\Controllers\user\CashController;
use App\Http\Controllers\user\CheckoutController;
use App\Http\Controllers\user\StripeController;
use App\Http\Controllers\user\WishlistController;
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



// ======================>>>Admin Auth<<<======================
Route::group(['prefix'=>'admin', 'middleware'=>['admin:admin']], function(){
    Route::get('/login', [backendAdminController::class, 'loginForm']);
    Route::post('/login', [backendAdminController::class, 'store'])->name('admin.login');
    
});

// ==========================================================================
// ========================= Start Backend Dashboard ========================== 
// ==========================================================================

Route::middleware(['auth:sanctum,admin', 'auth:admin', config('jetstream.auth_session'), 'verified'])->group(function () {
    // ======================>>> Admin Auth Logout <<<======================
    Route::get('/logout', [backendAdminController::class, 'destroy'])->name('admin.logout');

    // ======================>>>BackendController<<<======================
    Route::get('admin/dashboard', [BackendController::class, 'index'])->name('admin.dashboard');
    
    // ======================>>>ProfileController<<<======================
    Route::group(['prefix'=>'admin'], function(){
        Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile');
        Route::get('/profile/edit/{id}', [ProfileController::class, 'edit'])->name('admin.profile.edit');
        Route::post('/profile/update/{id}', [ProfileController::class, 'update'])->name('admin.profile.update');
        Route::get('/changePassword', [ProfileController::class, 'changePassword'])->name('admin.changePassword');
        Route::post('/updatePassword', [ProfileController::class, 'updatePassword'])->name('admin.updatePassword');

    });
    
    // ======================>>>BrandController<<<======================
    Route::group(['prefix'=>'brand'], function(){
        Route::get('/view', [BrandController::class, 'index'])->name('brand.view');
        Route::post('/store', [BrandController::class, 'store'])->name('brand.store');
        Route::get('/edit/{id}', [BrandController::class, 'edit'])->name('brand.edit');
        Route::post('/update', [BrandController::class, 'update'])->name('brand.update');
        Route::get('/destroy/{id}', [BrandController::class, 'destroy'])->name('brand.destroy');

    });

    // ======================>>>CategoryController<<<======================
    Route::group(['prefix'=>'category'], function(){
        Route::get('/view', [CategoryController::class, 'index'])->name('category.view');
        Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::post('/update', [CategoryController::class, 'update'])->name('category.update');
        Route::get('/destroy/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

    });

    // ======================>>>SubCategoryController<<<======================
    Route::group(['prefix'=>'subcategory'], function(){
        Route::get('/view', [SubCategoryController::class, 'index'])->name('SubCategory.view');
        Route::post('/store', [SubCategoryController::class, 'store'])->name('SubCategory.store');
        Route::get('/edit/{id}', [SubCategoryController::class, 'edit'])->name('SubCategory.edit');
        Route::post('/update', [SubCategoryController::class, 'update'])->name('SubCategory.update');
        Route::get('/destroy/{id}', [SubCategoryController::class, 'destroy'])->name('SubCategory.destroy');

    });

    // ======================>>>SubSubCategoryController<<<======================
    Route::group(['prefix'=>'subsubcategory'], function(){
        Route::get('/view', [SubSubCategoryController::class, 'index'])->name('SubSubCategory.view');
        Route::post('/store', [SubSubCategoryController::class, 'store'])->name('SubSubCategory.store');
        Route::get('/edit/{id}', [SubSubCategoryController::class, 'edit'])->name('SubSubCategory.edit');
        Route::post('/update', [SubSubCategoryController::class, 'update'])->name('SubSubCategory.update');
        Route::get('/destroy/{id}', [SubSubCategoryController::class, 'destroy'])->name('SubSubCategory.destroy');

        // =======>>>ajax<<<=======
        Route::get('/getsubcategory/ajax/{category_id}', [SubSubCategoryController::class, 'GetSubCategory']);
        Route::get('/getsubsubcategory/ajax/{subcategory_id}', [SubSubCategoryController::class, 'GetSubSubCategory']);

    });

    // ======================>>>ProductController<<<======================
    Route::group(['prefix'=>'product'], function(){
        Route::get('/view', [ProductController::class, 'index'])->name('product.view');
        Route::get('/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/store', [ProductController::class, 'store'])->name('product.store');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
        Route::post('/data/update', [ProductController::class, 'dataUpdate'])->name('product.dataUpdate');
        Route::post('/img/update', [ProductController::class, 'imgUpdate'])->name('product.imgUpdate');
        Route::post('/multiImg/update', [ProductController::class, 'multiImgUpdate'])->name('product.multiImgUpdate');
        Route::post('/multiImgAdd', [ProductController::class, 'multiImgAdd'])->name('product.multiImgAdd');
        Route::get('/multiImgDelete/{id}', [ProductController::class, 'multiImgDelete'])->name('product.multiImgDelete');
        Route::get('/Inactive/{id}', [ProductController::class, 'ProductInactive'])->name('product.Inactive');
        Route::get('/Active/{id}', [ProductController::class, 'ProductActive'])->name('product.Active');
        Route::get('/destroy{id}', [ProductController::class, 'destroy'])->name('product.destroy');

    });

    // ======================>>>SliderController<<<======================
    Route::group(['prefix'=>'slider'], function(){
        Route::get('/view', [SliderController::class, 'index'])->name('slider.view');
        Route::post('/store', [SliderController::class, 'store'])->name('slider.store');
        Route::get('/edit/{id}', [SliderController::class, 'edit'])->name('slider.edit');
        Route::post('/update', [SliderController::class, 'update'])->name('slider.update');

        Route::get('/Inactive/{id}', [SliderController::class, 'SliderInactive'])->name('slider.Inactive');
        Route::get('/Active/{id}', [SliderController::class, 'SliderActive'])->name('slider.Active');
        Route::get('/destroy{id}', [SliderController::class, 'destroy'])->name('slider.destroy');

    });
    
    // ======================>>>CouponController<<<======================
    Route::group(['prefix'=>'coupons'], function(){
        Route::get('/view', [CouponController::class, 'CouponView'])->name('coupon.view');
        Route::post('/store', [CouponController::class, 'store'])->name('coupon.store');
        Route::get('/edit/{id}', [CouponController::class, 'edit'])->name('coupon.edit');
        Route::post('/update/{id}', [CouponController::class, 'update'])->name('coupon.update');
        Route::get('/destroy/{id}', [CouponController::class, 'destroy'])->name('coupon.destroy');

    });
    
    // ======================>>>ShippingAreaController<<<======================
    Route::group(['prefix'=>'shipping'], function(){
        //======>>>Division<<<=======
        Route::get('/division/view', [ShippingAreaController::class, 'viewDivision'])->name('division.view');
        Route::post('/division/store', [ShippingAreaController::class, 'storeDivision'])->name('division.store');
        Route::get('/division/edit/{id}', [ShippingAreaController::class, 'editDivision'])->name('division.edit');
        Route::post('/division/update/{id}', [ShippingAreaController::class, 'updateDivision'])->name('division.update');
        Route::get('/division/destroy/{id}', [ShippingAreaController::class, 'destroyDivision'])->name('division.destroy');

        //======>>>District<<<=======
        Route::get('/district/view', [ShippingAreaController::class, 'viewDistrict'])->name('district.view');
        Route::post('/district/store', [ShippingAreaController::class, 'storeDistrict'])->name('district.store');
        Route::get('/district/edit/{id}', [ShippingAreaController::class, 'editDistrict'])->name('district.edit');
        Route::post('/district/update/{id}', [ShippingAreaController::class, 'updateDistrict'])->name('district.update');
        Route::get('/district/destroy/{id}', [ShippingAreaController::class, 'destroyDistrict'])->name('district.destroy');

        //======>>>State<<<=======
        Route::get('/state/view', [ShippingAreaController::class, 'viewState'])->name('state.view');
        Route::post('/state/store', [ShippingAreaController::class, 'storeState'])->name('state.store');
        Route::get('/state/edit/{id}', [ShippingAreaController::class, 'editState'])->name('state.edit');
        Route::post('/state/update/{id}', [ShippingAreaController::class, 'updateState'])->name('state.update');
        Route::get('/state/destroy/{id}', [ShippingAreaController::class, 'destroyState'])->name('state.destroy');
        // =======>>>ajax<<<=======
        Route::get('/state/division/ajax/{shipdivision_id}', [ShippingAreaController::class, 'divisionAjax']);

    });

});

// ==========================================================================
// ========================= End Backend Dashboard ========================== 
// ==========================================================================








// ==========================================================================
// ========================= Start User Dashboard ========================== 
// ==========================================================================

Route::middleware(['auth:sanctum,web', config('jetstream.auth_session'), 'verified'])->group(function () {

    // ======================>>>frontendAdminController<<<======================
    Route::get('dashboard', [UserController::class,  'index'])->name('user.dashboard');
    Route::get('/user/logout', [UserController::class,  'userLogout'])->name('user.logout');
    Route::get('/user/profileUpdate', [UserController::class,  'profileEdit'])->name('user.profileEdit');
    Route::post('/user/profileupdate', [UserController::class,  'profileUpdate'])->name('user.profileUpdate');
    Route::get('/user/changePassword', [UserController::class,  'changePsd'])->name('user.changePassword');
    Route::post('/user/updatePassword', [UserController::class,  'updatePassword'])->name('user.updatePassword');

    
    

});

// ==========================================================================
// ========================= End User Dashboard ========================== 
// ==========================================================================







// ==========================================================================
// ========================= Start Frontend All Routes ========================== 
// ==========================================================================

/// Multi Language All Routes ////
Route::get('/language/bangla', [LanguageController::class, 'bangla'])->name('bangla.language');
Route::get('/language/english', [LanguageController::class, 'english'])->name('english.language');

/// Multi Language All Routes ////
Route::get('/', [IndexController::class, 'index'])->name('homePage');

/// Details Route ////
Route::get('/product/details/{id}/{slug}', [IndexController::class, 'product_details']);
Route::get('/tagwise-product-details/{tag}', [IndexController::class, 'tagwise_product_details']);
Route::get('/SubCategorywise-product-details/{subcategory_id}/{slug}', [IndexController::class, 'subCategorywise_product_details']);
Route::get('/SubSubCategorywise-product-details/{subsubcategory_id}/{slug}', [IndexController::class, 'subSubCategorywise_product_details']);


/// Product View Modal with Ajax ////
Route::get('/product/view/modal/{id}', [IndexController::class, 'ProductViewAjax']);

// ======================>>>AddToCartController<<<======================
/// Product Add to Cart ////
Route::post('/cart/data/store/{id}', [AddToCartController::class, 'AddToCart']);

// Get Data from mini cart
Route::get('/product/mini/cart/', [AddToCartController::class, 'AddMiniCart']);
// Remove mini cart
Route::get('/minicart/product-remove/{rowId}', [AddToCartController::class, 'RemoveMiniCart']);
// Add to Wishlist
Route::post('/add-to-wishlist/{product_id}', [AddToCartController::class, 'AddToWishlist']);

// =============== Start Protected User ===============
Route::group(['prefix'=>'user', 'middleware' => ['user','auth'], 'namespace'=>'User'], function(){

    // Wishlist page
    // =============>>>WishlistController<<<=============
    Route::get('/wishlist', [WishlistController::class, 'ViewWishlist'])->name('wishlist');
    Route::get('/get-wishlist-product', [WishlistController::class, 'GetWishlistProduct']);
    Route::get('/wishlist-remove/{id}', [WishlistController::class, 'RemoveWishlistProduct']);

    // Payment Method
    // =============>>>StripeController<<<=============
    Route::post('/stripe/order', [StripeController::class, 'StripeOrderStore'])->name('stripe.order');
    Route::post('/cash/order', [CashController::class, 'CashOrder'])->name('cash.order');

    // =============>>>UserController<<<=============
    Route::get('/orders', [UserController::class,  'MyOrder'])->name('MyOrder');
    Route::get('/order-details/{order_id}', [UserController::class, 'OrderDetails']);
    Route::get('/invoice-download/{order_id}', [UserController::class, 'InvoiceDownload']);

}); // =============== Start Protected User ===============

    // My Cart page
// =============>>>CartPageController<<<=============
Route::get('/user/mycart', [CartPageController::class, 'ViewMyCart'])->name('mycart');
Route::get('/user/get-cart-product', [CartPageController::class, 'GetCartProduct']);
Route::get('/user/cart-remove/{rowId}', [CartPageController::class, 'RemoveCartProduct']);
Route::get('/user/cart-increment/{rowId}', [CartPageController::class, 'CartIncrement']);
Route::get('/user/cart-decrement/{rowId}', [CartPageController::class, 'CartDecrement']);



// Frontend Coupon Option
Route::post('/coupon-apply', [CartPageController::class, 'CouponApply']);
Route::get('/coupon-calculation', [CartPageController::class, 'CouponCalculation']);
Route::get('/coupon-remove', [CartPageController::class, 'CouponRemove']);

// Checkout Routes 
Route::get('/checkout', [CartPageController::class, 'CheckoutCreate'])->name('checkout');

    // ajax
// =============>>>CheckoutController<<<=============
Route::get('/district-get/ajax/{division_id}', [CheckoutController::class, 'DistrictGetAjax']);
Route::get('/state-get/ajax/{district_id}', [CheckoutController::class, 'StateGetAjax']);
Route::post('/checkout/store', [CheckoutController::class, 'CheckoutStore'])->name('checkout.store');

// ==========================================================================
// ========================= End Frontend All Routes ========================== 
// ==========================================================================
