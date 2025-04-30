<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ParticipantController;

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

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');
// Route::get('/news', [HomeController::class, 'news'])->name('news');
Route::get('/post/{slug}', [HomeController::class, 'post'])->name('post');
Route::get('/news/all', [HomeController::class, 'all_news'])->name('all.news');
Route::get('/login', [HomeController::class, 'login'])->name('login')->middleware('guest');
Route::get('/admin', [HomeController::class, 'admin'])->name('admin')->middleware('guest');
Route::get('/register', [HomeController::class, 'register'])->name('register')->middleware('guest');
Route::post('/login', [HomeController::class, 'login_store'])->name('login.store');
Route::post('/admin', [HomeController::class, 'admin_store'])->name('admin.store');
Route::post('/register', [HomeController::class, 'register_store'])->name('register.store');
Route::post('/logout', [HomeController::class, 'logout'])->name('logout');

// Role: Admin
Route::middleware('admin')->group(function () {
    Route::prefix('admin')->group(function () {
        // Registration
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::get('/classes', [AdminController::class, 'classes'])->name('classes');
        Route::get('/classes/print', [AdminController::class, 'classes_print'])->name('classes-print');
        Route::get('/classes/{id}', [AdminController::class, 'detail_class'])->name('detail-class');
        Route::get('/classes/{id}/export', [AdminController::class, 'detail_class_export'])->name('detail-class-export');
        Route::get('/classes/{id}/print', [AdminController::class, 'class_print'])->name('class-print');
        Route::post('/classes', [AdminController::class, 'classes_store'])->name('classes.store');
        Route::patch('/classes/{id}', [AdminController::class, 'class_edit'])->name('class.edit');
        Route::delete('/classes/{id}', [AdminController::class, 'class_delete'])->name('class-delete');

        Route::delete('/classes/{class}/{id}', [AdminController::class, 'athlete_class_delete'])->name('athlete_class-delete');
        Route::delete('/classes/{class}/{team}/{group}', [AdminController::class, 'team_class_delete'])->name('team_class-delete');

        Route::get('/teams', [AdminController::class, 'teams'])->name('teams');
        Route::get('/teams/print', [AdminController::class, 'teams_print'])->name('teams-print');
        Route::get('/teams/{id}', [AdminController::class, 'team'])->name('detail-team');
        Route::get('/teams/{id}/print', [AdminController::class, 'team_print'])->name('detail-team-print');
        Route::get('/teams/{id}/card', [AdminController::class, 'card_team'])->name('card-team');
        Route::get('/teams/{id}/verification', [AdminController::class, 'verificate_team'])->name('verificate-team');
        Route::patch('/teams/{id}', [AdminController::class, 'teams_validation'])->name('teams-validation');
        Route::delete('/teams/{id}', [AdminController::class, 'teams_delete'])->name('teams-delete');
        Route::get('/athletes', [AdminController::class, 'athletes'])->name('athletes');
        Route::get('/athletes/print', [AdminController::class, 'athletes_print'])->name('athletes-print');
        Route::get('/athletes/{id}', [AdminController::class, 'detail_athlete'])->name('detail-athlete');
        Route::get('/athletes/{id}/card', [AdminController::class, 'card_athlete'])->name('card-athlete');
        Route::get('/official/{id}/card', [AdminController::class, 'card_official'])->name('card-official');
        Route::patch('/athletes/{id}', [AdminController::class, 'athlete_validation'])->name('athlete-validation');
        Route::get('/payments', [AdminController::class, 'payments'])->name('payments');
        Route::get('/payments/print/{id}', [AdminController::class, 'payment_print'])->name('payment-print');
        Route::get('/payments/print', [AdminController::class, 'payments_print'])->name('payments-print');
        Route::get('/payments/{id}', [AdminController::class, 'payment'])->name('detail-payment');
        Route::patch('/payments/{id}', [AdminController::class, 'invoice_validation'])->name('invoice-validation');
        // Admin
        Route::get('/messages', [AdminController::class, 'messages'])->name('admin.messages');
        Route::post('/messages', [AdminController::class, 'messages_store'])->name('messages.store');
        Route::delete('/messages/{id}', [AdminController::class, 'messages_delete'])->name('messages.delete');
        Route::get('/news', [AdminController::class, 'news'])->name('admin.news');
        Route::get('/news/create', [AdminController::class, 'news_create'])->name('news.create');
        Route::post('/news/create', [AdminController::class, 'news_store'])->name('news.store');
        Route::get('/post/{slug}/edit', [AdminController::class, 'news_edit'])->name('news.edit');
        Route::patch('/post/{slug}', [AdminController::class, 'news_edit_process'])->name('news.edit.process');
        Route::delete('/post/{slug}', [AdminController::class, 'news_delete'])->name('news.delete');
        Route::get('/schedules', [AdminController::class, 'schedules'])->name('admin.schedules');
        Route::post('/schedules', [AdminController::class, 'schedules_store'])->name('schedules.store');
        Route::patch('/schedules/{id}', [AdminController::class, 'schedules_edit'])->name('schedules.edit');
        Route::delete('/schedules/{id}', [AdminController::class, 'schedules_delete'])->name('schedules.delete');
        Route::get('/venue', [AdminController::class, 'venue'])->name('admin.venue');
        Route::patch('/venue', [AdminController::class, 'venue_edit'])->name('venue.edit');
        Route::get('/galleries', [AdminController::class, 'galleries'])->name('admin.galleries');
        Route::patch('/galleries', [AdminController::class, 'galleries_edit'])->name('galleries.edit');
        Route::get('/sponsors', [AdminController::class, 'sponsors'])->name('admin.sponsors');
        Route::post('/sponsors', [AdminController::class, 'sponsors_store'])->name('sponsors.store');
        Route::patch('/sponsors/{id}', [AdminController::class, 'sponsors_edit'])->name('sponsors.edit');
        Route::delete('/sponsors/{id}', [AdminController::class, 'sponsors_delete'])->name('sponsors.delete');
        Route::get('/faqs', [AdminController::class, 'faqs'])->name('admin.faqs');
        Route::post('/faqs', [AdminController::class, 'faqs_store'])->name('faqs.store');
        Route::patch('/faqs/{id}', [AdminController::class, 'faqs_edit'])->name('faqs.edit');
        Route::delete('/faqs/{id}', [AdminController::class, 'faqs_delete'])->name('faqs.delete');
        Route::get('/transactions', [AdminController::class, 'transactions'])->name('admin.transactions');
        Route::patch('/transactions', [AdminController::class, 'transactions_edit'])->name('transactions.edit');
        Route::get('/systems', [AdminController::class, 'systems'])->name('admin.systems');
        Route::patch('/systems', [AdminController::class, 'systems_edit'])->name('systems.edit');
    });
});

// Role: Participant
Route::middleware('participant')->group(function () {
    // Registration
    Route::get('/dashboard', [ParticipantController::class, 'index'])->name('my-dashboard');
    Route::get('/team', [ParticipantController::class, 'team'])->name('my-team');
    Route::get('/team/print', [ParticipantController::class, 'team_print'])->name('my-team-print');
    Route::post('/team', [ParticipantController::class, 'team_store'])->name('team-store');
    Route::patch('/team/{id}', [ParticipantController::class, 'team_edit'])->name('team-edit');
    Route::delete('/team/{id}', [ParticipantController::class, 'team_delete'])->name('team-delete');
    Route::get('/edit-team', [ParticipantController::class, 'edit_team'])->name('edit-my-team');
    Route::patch('/edit-team', [ParticipantController::class, 'edit_team_process'])->name('edit-my-team-process');
    Route::get('/athletes', [ParticipantController::class, 'athletes'])->name('my-athletes');
    Route::get('/athlete/{id}', [ParticipantController::class, 'athlete'])->name('athlete');
    Route::post('/athletes', [ParticipantController::class, 'athletes_store'])->name('athlete-store');
    Route::patch('/athletes/{id}', [ParticipantController::class, 'athlete_edit'])->name('athlete-edit');
    Route::delete('/athletes/{id}', [ParticipantController::class, 'athlete_delete'])->name('athlete-delete');
    Route::get('/classes', [ParticipantController::class, 'classes'])->name('my-classes');
    Route::get('/classes/{id}', [ParticipantController::class, 'detail_class'])->name('detail-my-class');
    Route::post('/classes/{id}', [ParticipantController::class, 'athlete_class_store'])->name('athlete-class-store');
    Route::delete('/classes/{id}', [ParticipantController::class, 'athlete_class_delete'])->name('athlete-class-delete');
    Route::delete('/classes/{class}/{id}', [ParticipantController::class, 'team_class_delete'])->name('team-class-delete');
    Route::get('/payment', [ParticipantController::class, 'payment'])->name('my-payment');
    Route::patch('/payment/{id}', [ParticipantController::class, 'is_confirm'])->name('is-confirm');
});

// QR Code
Route::get('/qrcode', [QrCodeController::class, 'index']);
