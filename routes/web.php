<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Admin\AdminController;

// ── FRONT OFFICE ──────────────────────────
Route::get('/',            [HomeController::class, 'index'])->name('home');
Route::get('/restaurant',  [HomeController::class, 'restaurant'])->name('restaurant');
Route::get('/galerie',     [HomeController::class, 'gallery'])->name('gallery');
Route::get('/contact',     [HomeController::class, 'contact'])->name('contact');
Route::post('/contact',    [HomeController::class, 'sendContact'])->name('contact.send');

// rooms
Route::get('/chambres',       [RoomController::class, 'index'])->name('rooms.index');
Route::get('/chambres/{id}',  [RoomController::class, 'show'])->name('rooms.show');

// reservation
Route::get('/reservation',        [ReservationController::class, 'create'])->name('reservation.create');
Route::post('/reservation',       [ReservationController::class, 'store'])->name('reservation.store');
Route::get('/reservation/merci',  [ReservationController::class, 'thanks'])->name('reservation.thanks');

// ── ADMIN BACK OFFICE ─────────────────────
Route::get('/admin/connexion',    [AdminController::class, 'loginForm'])->name('admin.login');
Route::post('/admin/connexion',   [AdminController::class, 'login'])->name('admin.login.post');
Route::get('/admin/deconnexion',  [AdminController::class, 'logout'])->name('admin.logout');

Route::get('/admin',              [AdminController::class, 'dashboard'])->name('admin.dashboard');

// rooms crud
Route::get('/admin/chambres',                     [AdminController::class, 'rooms'])->name('admin.rooms');
Route::get('/admin/chambres/creer',               [AdminController::class, 'createRoom'])->name('admin.rooms.create');
Route::post('/admin/chambres/creer',              [AdminController::class, 'storeRoom'])->name('admin.rooms.store');
Route::get('/admin/chambres/{id}/modifier',       [AdminController::class, 'editRoom'])->name('admin.rooms.edit');
Route::post('/admin/chambres/{id}/modifier',      [AdminController::class, 'updateRoom'])->name('admin.rooms.update');
Route::get('/admin/chambres/{id}/supprimer',      [AdminController::class, 'deleteRoom'])->name('admin.rooms.delete');

// reservations
Route::get('/admin/reservations',                 [AdminController::class, 'reservations'])->name('admin.reservations');
Route::get('/admin/reservations/{id}',            [AdminController::class, 'showReservation'])->name('admin.reservations.show');
Route::post('/admin/reservations/{id}/statut',    [AdminController::class, 'updateStatus'])->name('admin.reservations.status');
Route::get('/admin/reservations/{id}/supprimer',  [AdminController::class, 'deleteReservation'])->name('admin.reservations.delete');

// clients
Route::get('/admin/clients',  [AdminController::class, 'clients'])->name('admin.clients');