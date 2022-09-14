<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Video;
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
    $post = Post::create(['name' => 'my 1 post']);
    $tag = Tag::findOrFail(1);
    $post->tags()->save($tag);
});

Route::get('/read', function () {
    $post = post::findOrFail(1);
    foreach ($post->tags as $tag) {
        echo $tag->name;
    }
});

Route::get('/update', function () {
    $post = post::findOrFail(2);
    $tag = Tag::findOrFail(2);
    #1
    // $post->tags()->save($tag);
    #2
    // foreach ($post->tags as $tag) {
    //     $tag->Where("name","=","php")->update(['name'=>'PHP New']);
    // }
    #3
    // $post->tags()->attach($tag);
    #4
    $post->tags()->sync([2]);

});

Route::get('/delete', function () {
    $post = post::findOrFail(1);
    $post->tags()->where("id","=",1)->detach();
    // foreach ($post->tags as $tag) {

    //     $tag->where("id","=",2)->detach();
    // }
});
