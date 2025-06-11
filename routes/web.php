<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AdminEventController;
use App\Http\Controllers\Admin\AdminTicketController;
use App\Http\Controllers\Admin\AdminConcertController;
use App\Http\Controllers\Admin\AdminPaymentController;
// ==================== PUBLIC ==================== //

// Halaman home bisa diakses tanpa login
Route::get('/', [HomeController::class, 'index'])->name('home');

// ==================== AUTH ==================== //

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Logout harus login dulu
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// ==================== AUTHENTICATED ROUTES ==================== //

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('dashboard', function () { return view('admin.dashboard'); })->name('dashboard');
    Route::resource('events', AdminEventController::class);
    Route::resource('tickets', AdminTicketController::class);
    Route::resource('concerts', AdminConcertController::class)->parameters([
        'concerts' => 'event'
    ]);
    Route::resource('payments', AdminPaymentController::class);
    Route::post('payments/{payment}/confirm', [AdminPaymentController::class, 'confirm'])->name('payments.confirm');
});

Route::middleware('auth')->group(function () {

    // Daftar event & detail event
    Route::get('/events', [EventController::class, 'listEvents'])->name('events.index');
    Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');
    Route::get('/concerts/finished', [EventController::class, 'finishedEvents'])->name('concerts.finished');
    Route::post('/concerts/{concert}/comments', [CommentController::class, 'store'])->name('concerts.show');
    Route::get('concerts/{conserts}/comments', [CommentController::class, 'index'])->name('concerts.show');


    // Detail tiket berdasarkan event
    Route::get('/events/{event}/tickets', [EventController::class, 'showTicketsByEvent'])->name('events.ticket');

    // Transaksi: proses pembelian tiket
    Route::post('/checkout', [TransactionController::class, 'store'])->name('checkout');
    Route::get('/transactions/{transaction}', [TransactionController::class, 'show'])->name('transactions.show');
    
    // Proses pembayaran
    Route::post('/payment/{transaction}/process', [PaymentController::class, 'process'])->name('payment.process');
    Route::get('/payment/manual/{transaction}', [PaymentController::class, 'manual'])->name('payment.manual');
    // Halaman pembayaran untuk transaksi tertentu
    Route::get('/payment/{transaction}', [PaymentController::class, 'show'])->name('payment.show');
    // Review event
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');

    Route::get('/contact', [ContactController::class, 'create'])->name('contact.form');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.submit');

});
