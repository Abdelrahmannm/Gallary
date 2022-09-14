<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\Staff;
use App\Models\Photo;

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
    return view('welcome');
});

Route::get('/create', function () {
    $staff = Staff::find(1);
    $staff->photos()->create(['path' => 'emaple.jpg']);
});
Route::get('/read', function () {
    $staff = Staff::find(1);
    foreach ($staff->photos as $photo) {
        echo $photo->path."<br>";
    }
});

Route::get('/update', function () {
    $staff = Staff::find(1);
    $photo=$staff->photos()->whereId(1)->first();
    $photo->path='new path';
    $photo->save();
});

Route::get('/delete', function () {
    $staff = Staff::find(1);
    $photo=$staff->photos()->whereId(1)->delete();
;
});
Route::get('/assign', function () {
    $staff = Staff::find(1);
    $photo = Photo::find(4);
    $staff->photos()->save($photo);
});
Route::get('/unassign', function () {
    $staff = Staff::find(1);
    $staff->photos()->Where("id","=",2)->update(["imageable_id"=>"0",'imageable_type'=>" "]);
});
