<?php

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

Route::get('/', function () {
    return view('pages/welcome');
})->name("home");

Route::get('about-us', function () {
    return view('pages/about');
})->name("about");
Route::view('contact-me', 'pages/contact', [
    'page_name' => 'contact me page',
    'page_description' => "this is description"
])->name("contact");
Route::get('pages/category/{id}', function ($id) {
    $cate = [
        '1' => 'books',
        '2' => 'cakes',
        '3' => 'makes'
    ];
    return view('category', [
        'the_id' => $cate[$id] ?? "this is not found"

    ]);
});
