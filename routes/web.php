<?php

use Illuminate\Support\Facades\Route;

// E-Learning Platform Routes
Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/courses', function () {
    return view('pages.courses');
})->name('courses');

Route::get('/course/{id}', function () {
    return view('pages.course-detail');
})->name('course-detail');

Route::get('/my-courses', function () {
    return view('pages.my-courses');
})->name('my-courses');

Route::get('/profile', function () {
    return view('pages.profile');
})->name('profile');

Route::get('/settings', function () {
    return view('pages.settings');
})->name('settings');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::post('/contact/submit', function () {
    return redirect()->route('contact')->with('success', 'Message sent successfully!');
})->name('contact.submit');

Route::get('/privacy', function () {
    return view('pages.privacy');
})->name('privacy');

Route::get('/terms-of-service', function () {
    return view('pages.terms-of-service');
})->name('terms-of-service');
