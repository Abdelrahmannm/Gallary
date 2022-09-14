<?php

use App\Http\Controllers\postController;
use App\Models\Country;
use App\Models\Post;
use App\Models\Photo;
use App\Models\Video;

use App\Models\Role;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// // Route::get('/about', function () {
// //     return ('about');
// // })->name("ab");
// // Route::get('/post/{id}', [postController::class, 'index']);


// Route::get('/insert', function() {
//     DB::insert('insert into posts (title, content) values (?, ?)', ["php with laravel title", 'php with laravel content']) ;
// });

// Route::get('/read', function () {
//     $results = DB::select('select * from posts where id = ?', [1]);
//     return var_dump($results);
//     // foreach ($results as $result) {
//     //     return $result->content;
//     // }
// });

// Route::get('/update', function() {
//     $updated=DB::update('update posts set title = "laravel" where id = ?', [1]);
//     return $updated;
// });
// Route::get('/delete', function() {
//     $deleted=DB::delete('delete from posts where id = ?', [1]);
//     return $deleted;
// });
// // Route::resource('posts', postController::class);
// Route::get('/contact', [postController::class, 'contact']);
// Route::get('post/{id}', [postController::class, 'show_post']);

####### using eloquent  READ ######
// Route::get('/read', function () {
// $posts= Post::all();
// foreach ($posts as $post) {
//     return $post->content;
// }
// });
// Route::get('/find', function () {
//     $post = Post::find(3);
//     return $post->content;
// });
// Route::get('/findwhere', function () {
//     $posts = Post::where("id", 3)->orderBy("id", "desc")->take(1)->get();
//     return $posts;
// });
// Route::get("/findmore", function () {
//     $posts=Post::findOrFail(2);
//     #$posts=Post::where('user_count','<',50)->firstOrFail();
//     return $posts;
// });
####### using eloquent  Insert ######
###used save as create
// Route::get("/basicinsert",function (){
// $post= new Post;
// $post->title="new eloquent title";
// $post->content="new eloquent content";
// $post->save();
// });

// Route::get("/create",function(){
// Post::create(['title'=> 'title from create method','content'=>'content from create method']);
// });

####used save as update
// Route::get("/basicinsert",function (){
//     $post=Post::find(2);
//     $post->title="new eloquent title";
//     $post->content="new eloquent content";
//     $post->save();
//     });
####use eloquent update

// Route::get('/update',function(){
// Post::where("id",3)->where("is_admin",0)->update(['title'=>"new title",'content'=>"new content"]);
// });

####use eloquent delete
// Route::get("/delete", function () {
// $post=Post::find(3);
// $post->delete();
// });

// Route::get('/delete2',function(){
// Post::destroy(2);
// Post::destroy([3,4,5]);
// });

// Route::get('/softdelete', function () {

//     Post::find(4)->delete();
// });

// Route::get('/readsoftdelete', function () {
//     // $post = Post::find(1);
//     // return $post;
//     //    $post= Post::withTrashed()->get();
//     //    return $post;
//     $post = Post::onlyTrashed()->get();
//     return $post;
// });

//----------------------------------------
// Route::get('/restore',function(){
// Post::withTrashed()->restore();
// });

// --------------------------------------------------
// Route::get('/forcedelete', function () {
//     Post::onlyTrashed()->forceDelete();
// });

#------------------------------------------------------------
#### eloquent relationships
// one to one relationship-------------------------------
// Route::get('/user/{id}/post', function ($id) {
//     return User::find($id)->post->title;
// });

// Route::get('/post/{id}/user', function ($id) {
//     return Post::find($id)->user->name;
// });
// one to many relationship------------------------------
// Route::get('/posts', function () {

//     $user = User::find(1);

//     foreach ($user->posts as $post) {

//         echo $post->title . '<br>';
//     }
// });
// many to many relationship------------------------------

// Route::get("/user/{id}/role", function ($id) {

//     $user = User::find($id);
//     foreach ($user->roles as $role ) {
//         return $role->name;
//     }
// });



// intermidate table ----------pivot table --------------------
// Route::get("user/pivot/{id}",function($id){

//  $user=User::find($id);
// foreach ($user->roles as $role) {
//    echo $role->pivot->created_at;
// }

// });
// Route::get("/user/country/{id}", function ($id) {
//     $country = Country::find($id);
//     foreach ($country->posts as $post) {
//         echo $post->title .'<br>';
//     }
// });

//-----------------------------polymorphic relationship ------------------------//
// Route::get("/user/{id}/photos", function ($id) {
//     $user = User::find($id);
//     foreach ($user->photos as $photo) {
//         echo $photo;
//     }
// });
// Route::get("/post/{id}/photos", function ($id) {
//     $post = Post::find($id);
//     foreach ($post->photos as $photo) {
//         echo $photo;
//     }
// });


// Route::get("/photo/{id}/post", function ($id) {
//     $photo = Photo::findOrFail($id);
//     return $photo->imageable;
// });

#------------------polymorphic many to many ----------------------------#
// Route::get("/post/tags", function () {
//     $post = Post::findOrFail(1);

//     foreach ($post->tags as $tag) {
//         echo $tag->name;
//     }

// });
// Route::get("/video/tags", function () {
//     $video = Video::findOrFail(1);
//     foreach ($video->tags as $tag) {
//         echo $tag->name;
//     }

// });


Route::get("/tag/post", function () {
    $tag = Tag::findOrFail(2);

    foreach ($tag->posts as $post) {
        echo $post->title;
    }

});


Route::get("/tag/video", function () {
    $tag = Tag::findOrFail(1);

    foreach ($tag->videos as $video) {
        echo $video->name;
    }

});
