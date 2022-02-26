<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomainOrSubdomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/


//Public routes for clients 

Route::middleware([
    'web',
    InitializeTenancyByDomainOrSubdomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {

    Route::get('/', function () {
        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    });

});

Route::group(['middleware'=>['web',PreventAccessFromCentralDomains::class, InitializeTenancyByDomainOrSubdomain::class, ],
        'as'=>'customer.','prefix'=>'','namespace'=>'App\Http\Controllers\Customer' ] ,function(){ 
            Route::get('/','PageController@index')->name('homePage');
            Route::get('/cart','PageController@showCartPage')->name('showCartPage');
            Route::get('/checkout','PageController@showCheckoutPage')->name('showCheckoutPage');
            Route::get('/thank-you','PageController@showThankyouPage')->name('showThankyouPage');
            Route::get('/get-css','PageController@serveCSS')->name('serveCSS');

            Route::post('/checkout','PageController@processCheckout')->name('processCheckout');

            Route::get('/products','ProductController@index')->name('products.index');
            Route::get('/products/{product}/','ProductController@show')->name('products.show');
            Route::post('/products/{product}/','ProductController@quickOrder')->name('products.quickOrder');

        } );


Route::group(['middleware'=>['universal','web', InitializeTenancyByDomainOrSubdomain::class]] ,function (){
    Auth::routes(['register' => false]);
} );
 




Route::group(['middleware'=>'web' , InitializeTenancyByDomainOrSubdomain::class,PreventAccessFromCentralDomains::class, ] , function(){

    Route::get('/home', function () {
        if (session('status')) {
            return redirect()->route('tenant.home')->with('status', session('status'));
        }
    
        return redirect()->route('tenant.home');
    });
    
    
   
    
    Route::group(['prefix' => 'admin', 'as' => 'tenant.', 'namespace' => 'App\Http\Controllers\Tenant', 'middleware' => ['auth',InitializeTenancyByDomainOrSubdomain::class,PreventAccessFromCentralDomains::class, ]], function () {
        Route::get('/', 'HomeController@index')->name('home');
        // Permissions
        Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
        Route::resource('permissions', 'PermissionsController');
    
        // Roles
        Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
        Route::resource('roles', 'RolesController');
    
        // Users
        Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
        Route::resource('users', 'UsersController');
    
        // Product
        Route::delete('products/destroy', 'ProductController@massDestroy')->name('products.massDestroy');
        Route::post('products/media', 'ProductController@storeMedia')->name('products.storeMedia');
        Route::post('products/ckmedia', 'ProductController@storeCKEditorImages')->name('products.storeCKEditorImages');
        Route::resource('products', 'ProductController');
    
        // Color Attribute
        Route::delete('color-attributes/destroy', 'ColorAttributeController@massDestroy')->name('color-attributes.massDestroy');
        Route::resource('color-attributes', 'ColorAttributeController');
    
        // Size Attribute
        Route::delete('size-attributes/destroy', 'SizeAttributeController@massDestroy')->name('size-attributes.massDestroy');
        Route::post('size-attributes/media', 'SizeAttributeController@storeMedia')->name('size-attributes.storeMedia');
        Route::post('size-attributes/ckmedia', 'SizeAttributeController@storeCKEditorImages')->name('size-attributes.storeCKEditorImages');
        Route::resource('size-attributes', 'SizeAttributeController');
    
        // Variation Attribute
        Route::delete('variation-attributes/destroy', 'VariationAttributeController@massDestroy')->name('variation-attributes.massDestroy');
        Route::post('variation-attributes/media', 'VariationAttributeController@storeMedia')->name('variation-attributes.storeMedia');
        Route::post('variation-attributes/ckmedia', 'VariationAttributeController@storeCKEditorImages')->name('variation-attributes.storeCKEditorImages');
        Route::resource('variation-attributes', 'VariationAttributeController');
    
        // Category
        Route::delete('categories/destroy', 'CategoryController@massDestroy')->name('categories.massDestroy');
        Route::post('categories/media', 'CategoryController@storeMedia')->name('categories.storeMedia');
        Route::post('categories/ckmedia', 'CategoryController@storeCKEditorImages')->name('categories.storeCKEditorImages');
        Route::resource('categories', 'CategoryController');
    
        // Wilaya
        Route::delete('wilayas/destroy', 'WilayaController@massDestroy')->name('wilayas.massDestroy');
        Route::resource('wilayas', 'WilayaController');
    
        // Commune
        Route::delete('communes/destroy', 'CommuneController@massDestroy')->name('communes.massDestroy');
        Route::resource('communes', 'CommuneController');
    
        // Delivery Company
        Route::delete('delivery-companies/destroy', 'DeliveryCompanyController@massDestroy')->name('delivery-companies.massDestroy');
        Route::post('delivery-companies/media', 'DeliveryCompanyController@storeMedia')->name('delivery-companies.storeMedia');
        Route::post('delivery-companies/ckmedia', 'DeliveryCompanyController@storeCKEditorImages')->name('delivery-companies.storeCKEditorImages');
        Route::resource('delivery-companies', 'DeliveryCompanyController');
    
        // Payment Method
        Route::delete('payment-methods/destroy', 'PaymentMethodController@massDestroy')->name('payment-methods.massDestroy');
        Route::post('payment-methods/media', 'PaymentMethodController@storeMedia')->name('payment-methods.storeMedia');
        Route::post('payment-methods/ckmedia', 'PaymentMethodController@storeCKEditorImages')->name('payment-methods.storeCKEditorImages');
        Route::resource('payment-methods', 'PaymentMethodController');
    
        // Customer
        Route::delete('customers/destroy', 'CustomerController@massDestroy')->name('customers.massDestroy');
        Route::resource('customers', 'CustomerController');
    
        // Order
        Route::delete('orders/destroy', 'OrderController@massDestroy')->name('orders.massDestroy');
        Route::resource('orders', 'OrderController');
    
        // Coupon
        Route::delete('coupons/destroy', 'CouponController@massDestroy')->name('coupons.massDestroy');
        Route::resource('coupons', 'CouponController');
    
        // Order Item
        Route::delete('order-items/destroy', 'OrderItemController@massDestroy')->name('order-items.massDestroy');
        Route::resource('order-items', 'OrderItemController');
    
        // Cart
        Route::delete('carts/destroy', 'CartController@massDestroy')->name('carts.massDestroy');
        Route::resource('carts', 'CartController');
    
        // Cart Item
        Route::delete('cart-items/destroy', 'CartItemController@massDestroy')->name('cart-items.massDestroy');
        Route::resource('cart-items', 'CartItemController');
    
        // Page
        Route::delete('pages/destroy', 'PageController@massDestroy')->name('pages.massDestroy');
        Route::post('pages/media', 'PageController@storeMedia')->name('pages.storeMedia');
        Route::post('pages/ckmedia', 'PageController@storeCKEditorImages')->name('pages.storeCKEditorImages');
        Route::resource('pages', 'PageController');
    
        // Menu
        Route::delete('menus/destroy', 'MenuController@massDestroy')->name('menus.massDestroy');
        Route::resource('menus', 'MenuController');
    
        // Menu Item
        Route::delete('menu-items/destroy', 'MenuItemController@massDestroy')->name('menu-items.massDestroy');
        Route::post('menu-items/media', 'MenuItemController@storeMedia')->name('menu-items.storeMedia');
        Route::post('menu-items/ckmedia', 'MenuItemController@storeCKEditorImages')->name('menu-items.storeCKEditorImages');
        Route::resource('menu-items', 'MenuItemController');
    
        // Task Status
        Route::delete('task-statuses/destroy', 'TaskStatusController@massDestroy')->name('task-statuses.massDestroy');
        Route::resource('task-statuses', 'TaskStatusController');
    
        // Task Tag
        Route::delete('task-tags/destroy', 'TaskTagController@massDestroy')->name('task-tags.massDestroy');
        Route::resource('task-tags', 'TaskTagController');
    
        // Task
        Route::delete('tasks/destroy', 'TaskController@massDestroy')->name('tasks.massDestroy');
        Route::post('tasks/media', 'TaskController@storeMedia')->name('tasks.storeMedia');
        Route::post('tasks/ckmedia', 'TaskController@storeCKEditorImages')->name('tasks.storeCKEditorImages');
        Route::resource('tasks', 'TaskController');
    
        // Tasks Calendar
        Route::resource('tasks-calendars', 'TasksCalendarController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);
    
        // Expense Category
        Route::delete('expense-categories/destroy', 'ExpenseCategoryController@massDestroy')->name('expense-categories.massDestroy');
        Route::resource('expense-categories', 'ExpenseCategoryController');
    
        // Income Category
        Route::delete('income-categories/destroy', 'IncomeCategoryController@massDestroy')->name('income-categories.massDestroy');
        Route::resource('income-categories', 'IncomeCategoryController');
    
        // Expense
        Route::delete('expenses/destroy', 'ExpenseController@massDestroy')->name('expenses.massDestroy');
        Route::resource('expenses', 'ExpenseController');
    
        // Income
        Route::delete('incomes/destroy', 'IncomeController@massDestroy')->name('incomes.massDestroy');
        Route::resource('incomes', 'IncomeController');
    
        // Expense Report
        Route::delete('expense-reports/destroy', 'ExpenseReportController@massDestroy')->name('expense-reports.massDestroy');
        Route::resource('expense-reports', 'ExpenseReportController');
    
        // Facebook Setting
        Route::delete('facebook-settings/destroy', 'FacebookSettingController@massDestroy')->name('facebook-settings.massDestroy');
        Route::resource('facebook-settings', 'FacebookSettingController');
    
        // Visual Identity
        Route::delete('visual-identities/destroy', 'VisualIdentityController@massDestroy')->name('visual-identities.massDestroy');
        Route::resource('visual-identities', 'VisualIdentityController');
    });
    Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
        // Change password
        if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
            Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
            Route::post('password', 'ChangePasswordController@update')->name('password.update');
            Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
            Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
        }
    });
    






});