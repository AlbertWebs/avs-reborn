<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishListController;
use App\Http\Controllers\CompareController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentsConroller;
use App\Http\Controllers\DemoController;







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


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::get('/find-us',[App\Http\Controllers\HomeController::class, 'contact'])->name('contact');
Route::get('/about-us',[App\Http\Controllers\HomeController::class, 'about'])->name('about');


Route::get('/special-offers',[App\Http\Controllers\HomeController::class, 'special_offers'])->name('special-offers');

Route::get('/terms-and-conditions',[App\Http\Controllers\HomeController::class, 'terms'])->name('terms');
Route::get('/privacy-policy',[App\Http\Controllers\HomeController::class, 'privacy'])->name('privacy');
Route::get('/shipping-policy',[App\Http\Controllers\HomeController::class, 'shipping'])->name('shipping');
Route::get('/delivery',[App\Http\Controllers\HomeController::class, 'delivery'])->name('delivery');
Route::get('/copyright',[App\Http\Controllers\HomeController::class, 'copyright'])->name('copyright');
Route::get('/our-portfolio',[App\Http\Controllers\HomeController::class, 'portfolio'])->name('portfolio');
Route::get('/our-portfolio/{id}',[App\Http\Controllers\HomeController::class, 'folio'])->name('folio');

//Search
Route::get('/search',[App\Http\Controllers\HomeController::class, 'search'])->name('search');
Route::get('/search-results',[App\Http\Controllers\HomeController::class, 'searchsite'])->name('search-results');
Route::get('/filter',[App\Http\Controllers\HomeController::class, 'filter'])->name('search-filter');
Route::get('/filters',[App\Http\Controllers\HomeController::class, 'filters'])->name('search-filters');
Route::get('/do-not',[App\Http\Controllers\HomeController::class, 'do_not'])->name('do-not');

Route::get('/changeCode',[App\Http\Controllers\HomeController::class, 'changeCode'])->name('do-not-change-code');


Route::post('/newsletter', [App\Http\Controllers\HomeController::class, 'newsletter'])->name('newsletter');
// Creates Offers Session
Route::get('/subscription-offers/{email}', [App\Http\Controllers\HomeController::class, 'subscription_offers'])->name('subscription-offers');


// Tags
Route::get('/product-tags/{slung}', [App\Http\Controllers\HomeController::class, 'product_tags'])->name('product_tags');

// Products
Route::group(['prefix'=>'products'], function(){
Route::get('/', [App\Http\Controllers\HomeController::class, 'all'])->name('all');
Route::get('/shop-by-category', [App\Http\Controllers\HomeController::class, 'categories'])->name('shop-by-category');
Route::get('/shop-by-brand', [App\Http\Controllers\HomeController::class, 'brand'])->name('shop-by-brand');
Route::get('/{slung}', [App\Http\Controllers\HomeController::class, 'product_category'])->name('product-category');
Route::get('/brand/{brand}', [App\Http\Controllers\HomeController::class, 'brands'])->name('shop-by-brand-single-brand');
});
Route::get('/products-discounts/{slung}', [App\Http\Controllers\HomeController::class, 'products_discounts'])->name('products-discounts');
// Single Product
Route::get('product/{slung}', [App\Http\Controllers\HomeController::class, 'product_single'])->name('product-single');
// Product Helpers
Route::get('/popup/{slung}', [App\Http\Controllers\HomeController::class, 'popup'])->name('popup');
Route::get('/fullscreen/{slung}', [App\Http\Controllers\HomeController::class, 'fullscreen'])->name('fullscreen');
// Blog Posts
Route::group(['prefix'=>'blog-posts'], function(){
    Route::get('/', [App\Http\Controllers\BlogController::class, 'index'])->name('blog.index');
    Route::get('/{slung}', [App\Http\Controllers\BlogController::class, 'blog'])->name('blog.post');
});
// Cart Routes
Route::group(['prefix'=>'shopping-cart'], function(){
Route::get('/', [CartController::class, 'index'])->name('cart');
Route::get('add-to-cart/{id}', [CartController::class, 'addCart'])->name('add.to.cart');
Route::post('update-cart', [CartController::class, 'update'])->name('update.cart');
Route::get('remove-from-cart/{id}', [CartController::class, 'destroy'])->name('remove.from.cart');
// Checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::get('/checkout/payment', [CheckoutController::class, 'payment'])->name('payment');
Route::get('/checkout/payment-last', [CheckoutController::class, 'payments'])->name('payments');
Route::post('checkout/login', [CheckoutController::class, 'login'])->name('checkout.login');
Route::post('checkout/create-user', [CheckoutController::class, 'create'])->name('checkout.create');
Route::get('checkout/placeOrder', [CheckoutController::class, 'placeOrderGet'])->name('checkout.order.get');
Route::post('checkout/placeOrder', [CheckoutController::class, 'placeOrder'])->name('checkout.order');
Route::post('/checkout/process-coupon', [CheckoutController::class, 'process_coupon'])->name('process_coupon');
Route::get('/checkout/remove-coupon/{code}', [CheckoutController::class, 'remove_coupon'])->name('remove-coupon');
Route::get('/wishlist', [WishListController::class, 'index'])->name('wishlist');

});
// WishList
Route::group(['prefix'=>'wishlist'], function(){
Route::get('/', [WishListController::class, 'index'])->name('wishlist');
Route::get('add-to-wishlist/{id}', [WishListController::class, 'addWish'])->name('add.to.wishlist');
Route::get('remove-from-wishlist/{id}', [WishListController::class, 'destroy'])->name('remove.from.wishlist');
});
// Compare
Route::group(['prefix'=>'compare'], function(){
Route::get('/', [CompareController::class, 'index'])->name('compare');
Route::get('add-to-compare/{id}', [CompareController::class, 'addCompare'])->name('add.to.compare');
Route::get('remove-from-compare/{id}', [CompareController::class, 'destroy'])->name('remove.from.compare');
Route::get('clear-compare', [CompareController::class, 'clear'])->name('clear.compare');
});

//Payment pages

Route::post('payments/veryfy/mpesa',[PaymentsConroller::class, 'verify']);//The Lipa na MPESA Page
Route::post('payments/veryfy/sitoki',[PaymentsConroller::class, 'stk']); //The Lipa na MPESA Page
Route::get('mpesa/confirm',[PaymentsConroller::class, 'confirm']);           //Rquired URL
Route::get('mpesa/validate',[PaymentsConroller::class, 'validation']);         //Rquired URL
Route::get('mpesa/register',[PaymentsConroller::class, 'register']);           //Rquired URL

Route::get('export', [DemoController::class, 'export'])->name('exporting');
Route::get('importExportView', [DemoController::class, 'importExportView']);
Route::get('import', [DemoController::class, 'import']);

Route::get('export', [DemoController::class, 'export'])->name('exporting');
Route::get('importExportView', [DemoController::class, 'importExportView']);
Route::get('import', [DemoController::class, 'import']);
Route::get('export-products', [DemoController::class, 'export_products'])->name('exporting-products');
Route::get('change-links', [DemoController::class, 'create_image_link'])->name('create_image_link');


Route::post('/secure-login', [App\Http\Controllers\HomeController::class, 'handleLogin']);

Route::get('/sub',[App\Http\Controllers\HomeController::class, 'sub'])->name('sub');

Route::post('/checkemail',[App\Http\Controllers\HomeController::class, 'checkEmail'])->name('checkEmail');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Users Routes
Auth::routes();
Route::middleware(['auth', 'user-access:user'])->group(function () {
    Route::group(['prefix'=>'dashboard'], function(){
        Route::get('/', [ClientController::class, 'index'])->name('dashboard.home');
        Route::post('/update-settings', [ClientController::class, 'save'])->name('dashboard.update');

        Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
        // SocialMedia
        Route::get('/facebook', [LoginController::class, 'facebook']);
        Route::get('/facebook/redirect', [LoginController::class, 'facebookRedirect']);
        Route::get('/google', [LoginController::class, 'google']);
        Route::get('/google/redirect', [LoginController::class, 'googleRedirect']);
    });
});

// Admin Routes
Auth::routes();
Route::middleware(['auth', 'user-access:admin'])->group(function () {

    Route::group(['prefix'=>'admin'], function(){


    //Login route


    Route::get('/',  [AdminsController::class, 'index'])->name('admin.home');
    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

    //reset password
    Route::get('/searches',  [AdminsController::class, 'Searches']);
    //Testimonial
    Route::get('/addTestimonial',  [AdminsController::class, 'addTestimonial']);
    Route::post('/add_Testimonial',  [AdminsController::class, 'add_Testimonial']);
    Route::get('/testimonials', [AdminsController::class, 'testimonials']);
    Route::get('/editTestimonial/{id}',  [AdminsController::class, 'editTestimonial']);
    Route::get('/deleteTestimonial/{id}',  [AdminsController::class, 'deleteTestimonial']);
    Route::post('/edit_Testimonial/{id}',  [AdminsController::class, 'edit_Testimonial']);


    Route::get('/edit-Product-slung',  [AdminsController::class, 'edit_Product_slung']);

    Route::get('/addProductToFacebookPixel','AdminsController@addProductToFacebookPixel');
    Route::get('/emptyProductToFacebookPixel','AdminsController@emptyProductToFacebookPixel');

    //Terms Privacy copyright
    //copyright
    Route::get('/copyright', [AdminsController::class, 'copyright']);
    Route::post('/edit_copyright',  [AdminsController::class, 'edit_copyright']);
    // Delivery Terms
    Route::get('/delivery', [AdminsController::class, 'delivery']);
    Route::post('/edit_delivery',  [AdminsController::class, 'edit_delivery']);
    //Privacy
    Route::get('/privacy', [AdminsController::class, 'privacy']);
    Route::get('/addPrivacy',  [AdminsController::class, 'addPrivacy']);
    Route::get('/editPrivacy/{id}',  [AdminsController::class, 'editPrivacy']);
    Route::post('/add_privacy',  [AdminsController::class, 'add_privacy']);
    Route::get('/delete_privacy/{id}', [AdminsController::class, 'delete_privacy']);
    Route::post('/edit_privacy/{id}',  [AdminsController::class, 'edit_privacy']);

    //values
    Route::get('/coupons', [AdminsController::class, 'coupons']);
    Route::get('/addCoupon',  [AdminsController::class, 'addCoupon']);
    Route::get('/editCoupon/{id}',  [AdminsController::class, 'editCoupon']);
    Route::post('/add_Coupon',  [AdminsController::class, 'add_Coupon']);
    Route::get('/delete_Coupon/{id}', [AdminsController::class, 'delete_Coupon']);
    Route::post('/edit_Coupon/{id}',  [AdminsController::class, 'edit_Coupon']);

    // Operations
    Route::get('/operations', [AdminsController::class, 'operations'])->name('operations');

    //values
    Route::get('/values', [AdminsController::class, 'values']);
    Route::get('/addValues',  [AdminsController::class, 'addValues']);
    Route::get('/editValues/{id}',  [AdminsController::class, 'editValues']);
    Route::post('/add_values',  [AdminsController::class, 'add_values']);
    Route::get('/delete_values/{id}', [AdminsController::class, 'delete_values']);
    Route::post('/edit_values/{id}',  [AdminsController::class, 'edit_values']);

    Route::get('/deleteOfferRestore', [AdminsController::class, 'deleteOfferRestore']);
    //Offers
    Route::get('/Products_offer', [AdminsController::class, 'Products_offer']);
    Route::get('/swapoffer/{id}', [AdminsController::class, 'swapoffer']);
    Route::get('/deleteOffer/{id}', [AdminsController::class, 'deleteOffer']);
    Route::post('/swap_offer/{id}', [AdminsController::class, 'swap_offer']);
    Route::get('/special_offer/{id}', [AdminsController::class, 'special_offer']);
    Route::post('/special_offer_post', [AdminsController::class, 'special_offer_post']);
    Route::get('/special_offer_edit/{id}', [AdminsController::class, 'special_offer_edit']);
    Route::get('/swap_full/{id}', [AdminsController::class, 'swap_full']);

    // Featured& trending
    Route::get('/swapTrending/{id}', [AdminsController::class, 'swapTrending']);
    Route::get('/swapFeatured/{id}', [AdminsController::class, 'swapFeatured']);
    Route::get('/swapSlider/{id}', [AdminsController::class, 'swapSlider']);
    Route::get('/swapBanner/{id}', [AdminsController::class, 'swapBanner']);

    Route::get('/wishlist', [AdminsController::class, 'wishlist']);

    //Who
    Route::get('/who', [AdminsController::class, 'who']);
    Route::get('/editWho/{id}',  [AdminsController::class, 'editWho']);
    Route::get('/delete_who/{id}', [AdminsController::class, 'delete_who']);
    Route::post('/edit_who/{id}',  [AdminsController::class, 'edit_who']);

    //Terms
    Route::get('/terms', [AdminsController::class, 'terms']);
    Route::get('/addTerms',  [AdminsController::class, 'addTerms']);
    Route::get('/editTerm/{id}',  [AdminsController::class, 'editTerm']);
    Route::post('/add_term',  [AdminsController::class, 'add_term']);
    Route::post('/edit_term/{id}',  [AdminsController::class, 'edit_term']);
    Route::get('/delete_term/{id}', [AdminsController::class, 'delete_term']);
    //About
    Route::get('/about', [AdminsController::class, 'about']);
    Route::post('/about_save',  [AdminsController::class, 'about_save']);
    //Services
    Route::get('/services', [AdminsController::class, 'services']);
    Route::get('/deleteService/{id}', [AdminsController::class, 'deleteService']);
    Route::post('/edit_Services/{id}',  [AdminsController::class, 'edit_Services']);
    Route::get('/editServices/{id}',  [AdminsController::class, 'editServices']);
    Route::get('/addService',  [AdminsController::class, 'addService']);
    Route::post('/add_Service',  [AdminsController::class, 'add_Service']);

    //Pricing
    Route::get('/pricing', [AdminsController::class, 'pricing']);
    Route::get('/deletePricing/{id}', [AdminsController::class, 'deletePricing']);
    Route::post('/edit_Pricing/{id}',  [AdminsController::class, 'edit_Pricing']);
    Route::get('/editPricing/{id}',  [AdminsController::class, 'editPricing']);
    Route::get('/addPricing',  [AdminsController::class, 'addPricing']);
    Route::post('/add_Pricing',  [AdminsController::class, 'add_Pricing']);

    //Video
    Route::get('/videos', [AdminsController::class, 'videos']);
    Route::get('/deleteVideo/{id}', [AdminsController::class, 'deleteVideo']);
    Route::post('/edit_Video/{id}',  [AdminsController::class, 'edit_Video']);
    Route::get('/editVideo/{id}',  [AdminsController::class, 'editVideo']);
    Route::post('/add_Video/{id}',  [AdminsController::class, 'add_Video']);
    Route::get('/addVideo',  [AdminsController::class, 'addVideo']);


    //Porfolio
    Route::get('/portfolio', [AdminsController::class, 'portfolio']);
    Route::get('/deletePortfolio/{id}', [AdminsController::class, 'deletePortfolio']);
    Route::post('/edit_Portfolio/{id}',  [AdminsController::class, 'edit_Portfolio']);
    Route::get('/editPortfolio/{id}',  [AdminsController::class, 'editPortfolio']);
    Route::get('/addPortfolio',  [AdminsController::class, 'addPortfolio']);
    Route::post('/add_Portfolio',  [AdminsController::class, 'add_Portfolio']);

    //How It Works
    Route::get('/how', [AdminsController::class, 'how']);
    Route::get('/deleteHow/{id}', [AdminsController::class, 'deleteHow']);
    Route::post('/edit_How/{id}',  [AdminsController::class, 'edit_How']);
    Route::get('/editHow/{id}',  [AdminsController::class, 'editHow']);
    Route::get('/addHow',  [AdminsController::class, 'addHow']);
    Route::post('/add_How',  [AdminsController::class, 'add_How']);

    //Gallery
    Route::get('/gallery', [AdminsController::class, 'gallery']);
    Route::get('/editGallery/{id}', [AdminsController::class, 'editGallery']);
    Route::get('/deleteGallery/{id}', [AdminsController::class, 'deleteGallery']);
    Route::post('/save_gallery/{id}',  [AdminsController::class, 'save_gallery']);
    Route::get('/addGallery',  [AdminsController::class, 'addGallery']);
    Route::get('/galleryList',  [AdminsController::class, 'galleryList']);
    Route::post('/add_Gallery',  [AdminsController::class, 'add_Gallery']);

    //Slider
    Route::get('/slider', [AdminsController::class, 'slider']);
    Route::get('/editSlider/{id}', [AdminsController::class, 'editSlider']);
    Route::get('/deleteSlider/{id}', [AdminsController::class, 'deleteSlider']);
    Route::post('/edit_Slider/{id}',  [AdminsController::class, 'edit_Slider']);
    Route::get('/addSlider',  [AdminsController::class, 'addSlider']);
    Route::post('/add_Slider',  [AdminsController::class, 'add_Slider']);

    //Banner
    Route::get('/banner', [AdminsController::class, 'banners']);
    Route::get('/editBanner/{id}', [AdminsController::class, 'editBanner']);
    Route::post('/edit_Banner/{id}',  [AdminsController::class, 'edit_Banner']);

    //Clients
    Route::get('/addClient',  [AdminsController::class, 'addClient']);
    Route::post('/add_Client',  [AdminsController::class, 'add_Client']);
    Route::get('/clients', [AdminsController::class, 'clients']);
    Route::get('/editClient/{id}',  [AdminsController::class, 'editClient']);
    Route::get('/deleteClient/{id}',  [AdminsController::class, 'deleteClient']);
    Route::post('/edit_Client/{id}',  [AdminsController::class, 'edit_Client']);


    //Clients
    Route::get('/addBrand',  [AdminsController::class, 'addBrand']);
    Route::post('/add_Brand',  [AdminsController::class, 'add_Brand']);
    Route::get('/brands', [AdminsController::class, 'brands']);
    Route::get('/editBrand/{id}',  [AdminsController::class, 'editBrand']);
    Route::get('/deleteBrand/{id}',  [AdminsController::class, 'deleteBrand']);
    Route::post('/edit_Brand/{id}',  [AdminsController::class, 'edit_Brand']);

    //Statisctics
    Route::get('/stats', [AdminsController::class, 'stats']);
    Route::get('/editStats/{id}',  [AdminsController::class, 'editStats']);
    Route::get('/deleteStats/{id}',  [AdminsController::class, 'deleteStats']);
    Route::post('/edit_Stats/{id}',  [AdminsController::class, 'edit_Stats']);

    //Pages
    Route::get('/pages', [AdminsController::class, 'pages']);
    Route::get('/editPage/{id}', [AdminsController::class, 'editPage']);
    Route::get('/deletePage/{id}', [AdminsController::class, 'deletePage']);
    Route::post('/edit_Page/{id}',  [AdminsController::class, 'edit_Page']);
    Route::get('/addPage',  [AdminsController::class, 'addPage']);
    Route::post('/add_Page',  [AdminsController::class, 'add_Page']);
    Route::post('/set_Page/{name}',  [AdminsController::class, 'set_Page']);
    Route::get('/setPage/{name}',  [AdminsController::class, 'setPage']);

    // My Api
    Route::get('/myApi',  [AdminsController::class, 'myApi']);
    Route::get('/invoices',  [AdminsController::class, 'invoices']);
    Route::get('/deleteInvoice/{id}',  [AdminsController::class, 'deleteInvoice']);
    Route::get('/approveInvoice/{id}',  [AdminsController::class, 'approveInvoice']);


    //Priducts
    Route::get('/products', [AdminsController::class, 'products']);
    Route::get('/Products-lte', [AdminsController::class, 'productslte']);

    Route::get('/editProduct/{id}', [AdminsController::class, 'editProduct']);
    Route::get('/editProductDetails/{id}', [AdminsController::class, 'editProductDetails']);
    Route::get('/deleteProduct/{id}', [AdminsController::class, 'deleteProduct']);
    Route::post('/edit_Product/{id}',  [AdminsController::class, 'edit_Product']);
    Route::post('/edit_Product_Details/{id}',  [AdminsController::class, 'edit_Product_Details']);
    Route::get('/addProduct',  [AdminsController::class, 'addProduct']);
    Route::post('/add_Product',  [AdminsController::class, 'add_Product']);


    //Admin
    Route::get('/admins', [AdminsController::class, 'admins']);
    Route::get('/editAdmin/{id}', [AdminsController::class, 'editAdmin']);
    Route::get('/deleteAdmin/{id}', [AdminsController::class, 'deleteAdmin']);
    Route::post('/edit_Admin/{id}',  [AdminsController::class, 'edit_Admin']);
    Route::get('/addAdmin',  [AdminsController::class, 'addAdmin']);
    Route::post('/add_Admin',  [AdminsController::class, 'add_Admin']);

    //Orders
    Route::get('/orders', [AdminsController::class, 'orders']);
    Route::get('/editOrders/{id}', [AdminsController::class, 'editOrders']);
    Route::get('/deleteOrders/{id}', [AdminsController::class, 'deleteOrders']);
    Route::get('/confrimOrder/{id}', [AdminsController::class, 'confrimOrder']);
    Route::get('/swapOrder/{id}', [AdminsController::class, 'swapOrder']);
    Route::post('/edit_Orders/{id}',  [AdminsController::class, 'edit_Orders']);
    Route::get('/addOrder',  [AdminsController::class, 'addOrder']);
    Route::post('/add_Order',  [AdminsController::class, 'add_Order']);

    //User
    Route::get('/users', [AdminsController::class, 'users']);
    Route::get('/editUser/{id}', [AdminsController::class, 'editUser']);
    Route::get('/deleteUser/{id}', [AdminsController::class, 'deleteUser']);
    Route::post('/edit_User/{id}',  [AdminsController::class, 'edit_User']);
    Route::get('/addUser',  [AdminsController::class, 'addUser']);
    Route::post('/add_User',  [AdminsController::class, 'add_User']);

    //Blog Controls
    Route::get('/blog', [AdminsController::class, 'blog']);
    Route::get('/editBlog/{id}', [AdminsController::class, 'editBlog']);
    Route::get('/delete_Blog/{id}', [AdminsController::class, 'delete_Blog']);
    Route::post('/edit_Blog/{id}',  [AdminsController::class, 'edit_Blog']);
    Route::get('/addBlog',  [AdminsController::class, 'addBlog']);
    Route::post('/add_blog',  [AdminsController::class, 'add_Blog']);
    //Categories Control
    Route::get('/categories', [AdminsController::class, 'categories']);
    Route::get('/editCategories/{id}', [AdminsController::class, 'editCategories']);
    Route::get('/deleteCategory/{id}', [AdminsController::class, 'deleteCategory']);
    Route::post('/edit_Category/{id}',  [AdminsController::class, 'edit_Category']);
    Route::get('/addCategory',  [AdminsController::class, 'addCategory']);
    Route::post('/add_Category',  [AdminsController::class, 'add_Category']);

    Route::get('/categoriesBanners', [AdminsController::class, 'categoriesBanners']);
    Route::get('/editCategoriesBanners/{id}', [AdminsController::class, 'editCategoriesBanners']);
    Route::get('/deleteCategoryBanners/{id}', [AdminsController::class, 'deleteCategoryBanners']);
    Route::post('/edit_CategoryBanners/{id}',  [AdminsController::class, 'edit_CategoryBanners']);
    Route::get('/addCategoryBanners',  [AdminsController::class, 'addCategoryBanners']);
    Route::post('/add_CategoryBanners',  [AdminsController::class, 'add_CategoryBanners']);

    Route::get('/tags', [AdminsController::class, 'tags']);
    Route::get('/editTag/{id}', [AdminsController::class, 'editTag']);
    Route::get('/deleteTag/{id}', [AdminsController::class, 'deleteTag']);
    Route::post('/edit_Tag/{id}',  [AdminsController::class, 'edit_Tag']);
    Route::get('/addTag',  [AdminsController::class, 'addTag']);
    Route::post('/add_Tag',  [AdminsController::class, 'add_Tag']);

    //Service Renreded Control
    Route::get('/service_rendered', [AdminsController::class, 'service_rendered']);
    Route::get('/editService_rendered/{id}', [AdminsController::class, 'editService_rendered']);
    Route::get('/deleteService_rendered/{id}', [AdminsController::class, 'deleteService_rendered']);
    Route::post('/edit_Service_rendered/{id}',  [AdminsController::class, 'edit_Service_rendered']);
    Route::get('/addService_rendered',  [AdminsController::class, 'addService_rendered']);
    Route::post('/add_Service_rendered',  [AdminsController::class, 'add_Service_rendered']);

    //Daily
    Route::get('/daily', [AdminsController::class, 'daily']);
    Route::get('/editDaily/{id}', [AdminsController::class, 'editDaily']);
    Route::get('/deleteDaily/{id}', [AdminsController::class, 'deleteDaily']);
    Route::post('/edit_Daily/{id}',  [AdminsController::class, 'edit_Daily']);
    Route::get('/addDaily',  [AdminsController::class, 'addDaily']);
    Route::post('/add_Daily',  [AdminsController::class, 'add_Daily']);


    //Sub Categories
    Route::get('/subCategories', [AdminsController::class, 'subCategories']);
    Route::get('/editSubCategories/{id}', [AdminsController::class, 'editSubCategories']);
    Route::get('/deleteSubCategory/{id}', [AdminsController::class, 'deleteSubCategory']);
    Route::post('/edit_SubCategory/{id}',  [AdminsController::class, 'edit_SubCategory']);
    Route::get('/addSubCategory',  [AdminsController::class, 'addSubCategory']);
    Route::post('/add_SubCategory',  [AdminsController::class, 'add_SubCategory']);

    //Active Services
    Route::get('/traceServices', [AdminsController::class, 'traceServices']);
    Route::get('/editTraceServices/{id}', [AdminsController::class, 'editTraceServices']);
    Route::get('/deleteTraceServices/{id}', [AdminsController::class, 'deleteTraceServices']);
    Route::post('/edit_TraceServices/{id}',  [AdminsController::class, 'edit_TraceServices']);
    Route::get('/addTraceServices',  [AdminsController::class, 'addTraceServices']);
    Route::post('/add_TraceServices',  [AdminsController::class, 'add_TraceServices']);

    // Generic Routes
    Route::get('/form', [AdminsController::class, 'form']);
    Route::get('/list', [AdminsController::class, 'list']);
    Route::get('/formfile', [AdminsController::class, 'formfile']);
    Route::get('/formfiletext', [AdminsController::class, 'formfiletext']);

    //Payments
    Route::get('/payments', [AdminsController::class, 'payments']);
    Route::get('/payments/explore/{id}', [AdminsController::class, 'payments_explore']);
    //MPESA Routes
    Route::get('/balance', [AdminsController::class, 'balance']);
    Route::get('/reverse', [AdminsController::class, 'reverse']);
    Route::get('/lnmo', [AdminsController::class, 'lnmo']);
    Route::get('/b2b', [AdminsController::class, 'b2b']);
    Route::get('/b2c', [AdminsController::class, 'b2c']);
    Route::get('/lnmo/confirm/{id}', [AdminsController::class, 'lnmo_confirm']);


    // Order
    Route::get('/orders/explore/{id}', [AdminsController::class, 'order_explore']);

    //Notifications
    Route::get('/notifications', [AdminsController::class, 'notifications']);
    Route::get('/notification/{id}', [AdminsController::class, 'notification']);
    Route::get('/deleteNotification/{id}', [AdminsController::class, 'deleteNotification']);

    //Service Requests
    Route::get('/requests', [AdminsController::class, 'quoterequeste']);
    Route::get('/markRequest/{id}/{status}/{type}', [AdminsController::class, 'markRequest']);

    //Comments
    Route::get('/reviews', [AdminsController::class, 'reviews']);
    Route::get('/approve/{id}', [AdminsController::class, 'approve']);
    Route::get('/decline/{id}', [AdminsController::class, 'decline']);

    // Error Pages
    Route::get('/403', [AdminsController::class, 'error403']);
    Route::get('/404', [AdminsController::class, 'error404']);
    Route::get('/405', [AdminsController::class, 'error405']);
    Route::get('/500', [AdminsController::class, 'error500']);
    Route::get('/503', [AdminsController::class, 'error503']);





    // Subscribers Mail
    Route::post('/updatemail', [AdminsController::class, 'updatemail']);


    //Updates
    Route::get('/updates', [AdminsController::class, 'updates']);
    Route::get('/update/{id}', [AdminsController::class, 'update']);
    Route::get('/mark/{id}', [AdminsController::class, 'mark']);

    //profile
    Route::get('/profile', [AdminsController::class, 'profile']);
    Route::post('/profile_save/{id}', [AdminsController::class, 'profile_save']);
    Route::get('/editFile/{id}', [AdminsController::class, 'editFile']);
    Route::post('/edit_File/{id}', [AdminsController::class, 'edit_File']);

    // Gallery
    Route::get('/gallery', [AdminsController::class, 'gallery']);

    //Under Contruction
    Route::get('/under_construction', [AdminsController::class, 'under_construction']);

    //Wizard
    Route::get('/wizard', [AdminsController::class, 'wizard']);

    //Maps
    Route::get('/maps', [AdminsController::class, 'maps']);
    // SiteSettings
    Route::get('/sitesettings', [AdminsController::class, 'sitesettings']);
    Route::post('/savesitesettings', [AdminsController::class, 'savesitesettings']);
    //Messages
    Route::get('/allMessages',  [AdminsController::class, 'allMessages']);
    Route::get('/unread',  [AdminsController::class, 'unread']);
    Route::get('/read/{id}',  [AdminsController::class, 'read']);
    Route::post('/reply/{id}',  [AdminsController::class, 'reply']);
    Route::get('/deleteMessage/{id}',  [AdminsController::class, 'deleteMessage']);

    //Subscribers
    Route::get('/subscribers',  [AdminsController::class, 'subscribers']);
    Route::get('/mailSubscribers/{email}',  [AdminsController::class, 'mailSubscribers']);
    Route::get('/mailSubscriber/{email}',  [AdminsController::class, 'mailSubscriber']);
    Route::get('/deleteSubscriber/{id}',  [AdminsController::class, 'deleteSubscriber']);
    // Version Control
    Route::get('/version',  [AdminsController::class, 'version']);

    // Seo Settings
    // SeoSettings
    Route::get('/seosettings', [AdminsController::class, 'seosettings']);
    Route::post('/saveseosettings', [AdminsController::class, 'saveseosettings']);

    Route::get('/addProductToFacebookPixel', [AdminsController::class, 'addProductToFacebookPixel']);
    Route::get('/emptyProductToFacebookPixel', [AdminsController::class, 'emptyProductToFacebookPixel']);
    Route::get('/updateCategory', [AdminsController::class, 'updateCategory']);
    Route::get('/Without', [AdminsController::class, 'google_product_category']);
    });
});

Route::get('get/details/{id}', 'PaymentsConroller@getDetails')->name('getDetails');

// MPESA
Route::group(['prefix'=>'payments'], function(){
Route::post('/B2C/{AccID}','PaymentsConroller@B2C');
Route::get('/balance/{AccID}','PaymentsConroller@Balance');
Route::post('/reverse','PaymentsConroller@reversal');
Route::post('/TransactionStatus/{AccID}','PaymentsConroller@TransactionStatus');
Route::post('/B2B/{AccID}','PaymentsConroller@B2B');
Route::post('/C2B','PaymentsConroller@C2B');
Route::post('/transStatus/{AccID}','PaymentsConroller@TransactionStatus');
Route::get('/stk','PaymentsConroller@stk');
Route::get('/C2B','PaymentsConroller@C2B');
//Post STK
Route::post('/stk','PaymentsConroller@stk');
Route::get('/check/{ref}','PaymentsConroller@check');
});


Route::get('sitemap', function() {

	// create new sitemap object
	$sitemap = App::make('sitemap');

	// set cache key (string), duration in minutes (Carbon|Datetime|int), turn on/off (boolean)
	// by default cache is disabled
	$sitemap->setCache('laravel.sitemap', 10);

	// check if there is cached sitemap and build new only if is not
	if (!$sitemap->isCached()) {
		// add item to the sitemap (url, date, priority, freq)
		$sitemap->add(URL::to('/'), '2012-08-25T20:10:00+02:00', '1.0', 'daily');



		// get all posts from db
		$post = DB::table('category')->orderBy('created_at', 'desc')->get();

        // add every category to the sitemap
		foreach ($post as $post) {
			$sitemap->add("https://www.amanivehiclesounds.co.ke/products/$post->slung",'2012-08-25T20:10:00+02:00', '0.9', 'daily');
		}

        // get all posts from db
		$post = DB::table('brands')->orderBy('created_at', 'desc')->get();

        // add every category to the sitemap
		foreach ($post as $post) {
			$sitemap->add("https://www.amanivehiclesounds.co.ke/products/brand/$post->name",'2012-08-25T20:10:00+02:00', '0.9', 'daily');
		}


		  // get all posts from db
		  $post = DB::table('tags')->orderBy('created_at', 'desc')->get();

		  // add every category to the sitemap
		  foreach ($post as $post) {
			  $sitemap->add("https://www.amanivehiclesounds.co.ke/product-tags/$post->slung",'2012-08-25T20:10:00+02:00', '0.9', 'daily');
		  }


        // get all posts from db
        $posts = DB::table('product')->orderBy('created_at', 'desc')->get();
		// add every product to the sitemap
		foreach ($posts as $post) {
			$sitemap->add("https://www.amanivehiclesounds.co.ke/product/$post->slung",'2012-08-25T20:10:00+02:00', '0.8', 'daily');
		}
	}

	// show your sitemap (options: 'xml' (default), 'html', 'txt', 'ror-rss', 'ror-rdf')
	return $sitemap->render('xml');
});



