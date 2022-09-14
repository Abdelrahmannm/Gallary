<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Post;
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
$user=User::findOrFail(1);
$post= new Post(['title'=>'new php','body'=>'first php']);
$user->posts()->save($post);

#OR $user->posts()->save(new Post(['title'=>'new post','body'=>'first body']));

});

Route::get('/read', function () {
    $user = User::findOrFail(1);
    foreach ($user->posts as $post) {
       echo $post->title ."<br>";
    }
});

Route::get('/update', function () {
    $user = User::findOrFail(1);
    $user->posts()->where("id","=",1)->update(['title'=>"3yad",'body'=>'learning laravel']);
});

Route::get('/delete', function () {
    $user = User::findOrFail(1);
    $user->posts()->where("id","=",2)->delete();

});
