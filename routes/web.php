<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PaymentGatewayController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentsGateway\PaypalController;
use App\Http\Controllers\PaymentsGateway\CashfreeController;
use App\Http\Controllers\PaymentsGateway\StripeController;
use App\Http\Controllers\PaymentsGateway\EasebuzzController;
use App\Http\Controllers\PaymentsGateway\PayUController;
use App\Http\Controllers\PaymentsGateway\PhonePeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SalesReportController;
use App\Http\Controllers\SearchController;

// Frontend Controllers
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController as FrontendProductController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\ContactController as FrontendContactController;
use App\Http\Controllers\Frontend\PayPalPaymentController;
use App\Http\Controllers\Frontend\CashfreePaymentController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\PagesController;
use App\Http\Controllers\Frontend\SolutionsController;

/*
|--------------------------------------------------------------------------
| FRONTEND ROUTES (Public Website)
|--------------------------------------------------------------------------
| All routes for the public-facing website
| Accessible at: /
*/

// Home & Main Pages
Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/about', 'about')->name('about');
    Route::get('/contact', 'contact')->name('contact.page');
});

// Frontend Products
Route::prefix('products')->name('frontend.products.')->group(function () {
    Route::get('/', [FrontendProductController::class, 'showcase'])->name('showcase');
    Route::get('/{slug}', [FrontendProductController::class, 'showPublic'])->name('show');
});

// Checkout & Payments
Route::get('/checkout', [FrontendProductController::class, 'checkout'])->name('checkout');
Route::controller(CheckoutController::class)->group(function () {
    Route::post('/checkout/test', 'testCheckout')->name('checkout.process');
    Route::get('/payment/success', 'paymentSuccess')->name('payment.success');
    Route::get('/payment/failure', 'paymentFailure')->name('payment.failure');
});

// Payment Gateway Routes
Route::prefix('payment')->name('payment.')->group(function () {
    Route::get('/gateways/active', [FrontendProductController::class, 'getActiveGateways'])->name('gateways.active');
    Route::post('/process', [FrontendProductController::class, 'processPayment'])->name('process');
    Route::post('/gateway/process', [FrontendProductController::class, 'processGatewayPayment'])->name('gateway.process');
    
    // PayPal
    Route::prefix('paypal')->name('paypal.')->group(function () {
        Route::get('/process/{order}', [PayPalPaymentController::class, 'process'])->name('process');
        Route::get('/success', [PayPalPaymentController::class, 'success'])->name('success');
        Route::get('/cancel', [PayPalPaymentController::class, 'cancel'])->name('cancel');
        Route::get('/create/{checkout}', [PayPalPaymentController::class, 'create'])->name('create');
    });
    
    // Cashfree
    Route::prefix('cashfree')->name('cashfree.')->group(function () {
        Route::get('/process/{order}', [CashfreePaymentController::class, 'process'])->name('process');
        Route::post('/callback', [CashfreePaymentController::class, 'callback'])->name('callback');
        Route::get('/return', [CashfreePaymentController::class, 'return'])->name('return');
        Route::get('/create/{checkout}', [CashfreePaymentController::class, 'create'])->name('create');
    });
});

// Contact Form Submission
Route::post('/contact', [FrontendContactController::class, 'store'])->name('contact.store');

// Blog Routes
Route::prefix('blog')->name('blog.')->controller(BlogController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{slug}', 'show')->name('show');
});

// Solutions/Services Routes
Route::prefix('solutions')->name('solutions.')->controller(SolutionsController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{slug}', 'show')->name('show');
});

// Pages Routes
Route::controller(PagesController::class)->group(function () {
    Route::get('/faq', 'faq')->name('faq');
    Route::get('/team', 'team')->name('team');
    Route::get('/testimonials', 'testimonials')->name('testimonials');
});

/*
|--------------------------------------------------------------------------
| ADMIN AUTH ROUTES
|--------------------------------------------------------------------------
| Login & Register for Admin Panel
*/

// Admin Login & Register (Public)
Route::middleware('web')->group(function() {
	Route::match(['get', 'post'], '/admin/login', [LoginController::class, 'login'])->name('admin.login');
	Route::get('/admin/register', [RegisterController::class, 'register'])->name('admin.register');
	Route::post('/admin/register', [RegisterController::class, 'register'])->name('admin.register.post');
});

/*
|--------------------------------------------------------------------------
| ADMIN PANEL ROUTES
|--------------------------------------------------------------------------
| Protected admin routes accessible at /admin/*
| Requires authentication and admin role
*/

// Admin module routes (protected with admin middleware)
Route::prefix('admin')->middleware(['web', 'auth', 'admin'])->group(function() {
	Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
	
	// Product Management Routes (Admin Web Only)
	Route::get('products', [ProductController::class, 'index'])->name('products.index');
	Route::get('add-product', [ProductController::class, 'create'])->name('add-product');
	Route::post('products', [ProductController::class, 'store'])->name('products.store');
	Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
	Route::put('products/{product}', [ProductController::class, 'update'])->name('products.update');
	Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
	Route::post('products/{product}/toggle-status', [ProductController::class, 'toggleStatus'])->name('products.toggle-status');
	Route::delete('products/{product}/images/{imageIndex}', [ProductController::class, 'removeImage'])->name('products.remove-image');
	Route::get('products/slug/{slug}', [ProductController::class, 'adminShow'])->name('products.admin-show');
	Route::get('products/{slug}', [ProductController::class, 'show'])->name('products.show');
	
	// Payment Gateway Management
	Route::get('payments',[PaymentGatewayController::class, 'index'])->name('payments.index');
	Route::post('payments/{gateway}/status', [PaymentGatewayController::class, 'updateStatus'])->name('payments.update-status');
	Route::get('payments/statistics', [PaymentGatewayController::class, 'statistics'])->name('payment.gateways.statistics');
	
	// Active Payment Gateways (Only Cashfree and PayPal)
	// Admin gateway configuration routes - use explicit routes to avoid conflicts
	Route::prefix('paypal')->name('admin.paypal.')->group(function () {
	    Route::get('/edit', [PaypalController::class, 'edit'])->name('edit');
	    Route::put('/update/{id}', [PaypalController::class, 'update'])->name('update');
	});
	
	Route::prefix('cashfree')->name('admin.cashfree.')->group(function () {
	    Route::get('/edit', [CashfreeController::class, 'edit'])->name('edit');
	    Route::put('/update/{id}', [CashfreeController::class, 'update'])->name('update');
	    Route::post('/test', [CashfreeController::class, 'test'])->name('test');
	});
	
	// Payment gateway status management
	Route::post('payments/gateway/{gateway}/status', [PaymentGatewayController::class, 'updateStatus'])->name('payments.gateway.status');
	Route::get('payments/gateway/statistics', [PaymentGatewayController::class, 'statistics'])->name('payments.gateway.statistics');
	
	// Subscription Management
	Route::get('subscription', [SubscriptionController::class, 'index'])->name('subscription.index');
	Route::get('subscription/{id}', [SubscriptionController::class, 'show'])->name('subscription.show');
	Route::get('subscription/{id}/edit', [SubscriptionController::class, 'edit'])->name('subscription.edit');
	Route::put('subscription/{id}', [SubscriptionController::class, 'update'])->name('subscription.update');
	Route::delete('subscription/{id}', [SubscriptionController::class, 'destroy'])->name('subscription.destroy');
	
	// Contact Management
	Route::get('contacts', [ContactController::class, 'index'])->name('contacts.index');
	Route::get('contacts/{id}', [ContactController::class, 'show'])->name('contacts.show');
	Route::post('contacts/{contact}/archive', [ContactController::class, 'archive'])->name('contacts.archive');
	Route::post('contacts/{contact}/unarchive', [ContactController::class, 'unarchive'])->name('contacts.unarchive');
	Route::post('contacts/{contact}/reply', [ContactController::class, 'reply'])->name('contacts.reply');
	Route::get('contacts/archived/list', [ContactController::class, 'archived'])->name('contacts.archived');
	
	// Sales Reports
	Route::get('sales', [SalesReportController::class, 'index'])->name('sales.dashboard');
	Route::get('sales/report', [SalesReportController::class, 'report'])->name('sales.report');
	Route::get('sales/chart-data', [SalesReportController::class, 'chartData'])->name('sales.chart-data');
	Route::get('sales/export', [SalesReportController::class, 'export'])->name('sales.export');
	
	// Search
	Route::get('search/global', [SearchController::class, 'globalSearch'])->name('search.global');
	
	// Logout
	Route::get('logout', [LoginController::class, 'logout'])->name('logout');
	
// End of admin route definitions
});

