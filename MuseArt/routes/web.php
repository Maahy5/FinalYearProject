<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ExhibitionController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\WishlistController;
use App\Http\Middleware\AdminMiddleware;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authenticate;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




Route::get('/', [WelcomeController::class, 'index'])
    ->middleware('guest') // Ensure only guests can access the welcome page
    ->name('welcome');


Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');

Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

Route::get('/artists/artist', [ArtistController::class, 'showNotificationPage'])->name('artists.page');
Route::get('/artists/{id}', [ArtistController::class, 'showArtistsPage'])->name('artists.artist');
Route::post('/artists/{artistId}/send_notifications', [ArtistController::class, 'sendNotifications'])->name('artist.sendNotifications');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('index', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/home', [HomeController::class, 'index'])->name('home');

//Route for products

Route::middleware('auth')->group(function () {
    Route::get('/products/index', [ProductController::class, 'index'])->name('products');
    Route::get('/products/{slug}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id
    }', [ProductController::class, 'destroy'])->name('products.destroy');
});

//Route for gallery view
Route::get('/gallery/index', [GalleryController::class, 'index'])->name('gallery.index');

Route::get('/gallery/show/{id}', [GalleryController::class, 'show'])->name('gallery.show');

Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');

Route::post('/logout', [AuthenticatedSessionController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {

    Route::get('/artists', [ArtistController::class, 'index'])->name('artists');
    Route::get('/artists/edit/{id}', [ArtistController::class, 'edit'])->name('artists.edit');
    Route::get('/artists/{id}', [ArtistController::class, 'show'])->name('artists.show');
    Route::get('/artists/create', [ArtistController::class, 'create'])->name('artists.create');
    Route::post('/artists', [ArtistController::class, 'store'])->name('artists.store');
    Route::put('/artists/{id}', [ArtistController::class, 'update'])->name('artists.update');
    Route::delete('/artists/{id}', [ArtistController::class, 'destroy'])->name('artists.destroy');
});

//For 

Route::post('/subscribe/{artist}', [SubscriptionController::class, 'subscribe'])->name('subscribe');
Route::post('/unsubscribe/{artist}', [SubscriptionController::class, 'unsubscribe'])->name('unsubscribe');

Route::get('/exhibitions/events', [EventController::class, 'upcomingEvents'])->name('exhibitions.events');




//Route::get('/exhibitions/events', [EventController::class, 'getEvents'])->name('exhibitions.events');
//Route::get('/exhibitions/events', [ExhibitionController::class, 'getEvents'])->name('exhibitions');

Route::get('/events', [EventController::class, 'getEvents'])->name('events.get');

Route::get('/events/index', [EventController::class, 'index'])->name('events');
Route::get('/events/show', [EventController::class, 'show'])->name('events.show');
Route::get('events/create', [EventController::class, 'create'])->name('events.create');
Route::get('/events/{id}/edit', [EventController::class, 'edit'])->name('events.edit');
Route::put('/events/{id}', [EventController::class, 'update'])->name('events.update');
Route::post('/events/store', [EventController::class, 'store'])->name('events.store');

Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('events.destroy');

Route::middleware(['auth'])->group(function () {
    Route::get('wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist', [WishlistController::class, 'store'])->name('wishlist.store');
    Route::delete('/wishlist/{id}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');
});

/* //admin
Route::get('/admin/wishlist', [WishlistController::class, 'getWishlists'])->name('wishlist.admin');
// Admin's wishlist delete (admins can delete any wishlist item)
Route::delete('/admin/wishlist/{id}', [WishlistController::class, 'adminDestroy'])->name('admin.wishlist.destroy')->middleware('auth', 'admin'); */

Route::middleware(['auth'])->group(function () {
    Route::get('/notification', [NotificationController::class, 'index'])->name('notification.index');
    Route::post('/notification', [NotificationController::class, 'store'])->name('notification.store');
    Route::delete('/notification/{id}', [NotificationController::class, 'destroy'])->name('notification.destroy');
});

Route::get('/user/index', [UserController::class, 'index'])->name('user.index');
//Route::get('/user/index/create', [UserController::class, 'create'])->name('events.create');
Route::get('/user/edit/{id}', [UserController::class, 'index'])->name('users.edit');
Route::delete('/user/index/{id}', [UserController::class, 'destroy'])->name('users.destroy');


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

Route::post('/payment/verify', [ProductController::class, 'verifyKhaltiPayment'])->name('verify.payment');


Route::get('initiate-payment', [ProductController::class, 'initiatePayment']);
Route::get('payment/callback', [ProductController::class, 'paymentCallback'])->name('payment.callback');

require __DIR__ . '/auth.php';
