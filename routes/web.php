<?php

use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Models\Category;
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
//Route::view('/', 'welcome');

Route::get('/', function () {
  return view('home', [
    'title' => 'Home',
    'active' => 'home',
  ]);
});

Route::view('/about', 'about', [
  'title' => 'About',
  'active' => 'about',
  'name' => 'Mohammad Asrofil Nadib',
  'email' => 'asrofilnadibs28@gmail.com',
  'image' => 'nadib.jpg',
]);

Route::get('/posts', [PostController::class, 'index']);
Route::get('posts/{post:slug}', [PostController::class, 'show']);

Route::get('/categories', function () {
  return view('categories', [
    'title' => 'Category Post',
    'active' => 'categories',
    'categories' => Category::all(),
  ]);
});

Route::get('/login', [LoginController::class, 'index'])
  ->name('login')
  ->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register',[RegisterController::class, 'index'])
  ->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', function () {
  return view('dashboard.index');
})->middleware('auth');

Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug'])
  ->middleware('auth');
Route::resource('/dashboard/posts', DashboardPostController::class)
  ->middleware('auth');

Route::resource('/dashboard/categories', AdminCategoryController::class)
  ->middleware('admin');

/*Route::get('/categories/{category:slug}', function (Category $category) {
  return view('posts', [
    'title' => "Post By Category : $category->name",
    'active' => 'categories',
    'posts' => $category->posts->load('category', 'author'),
  ]);
});*/

/*Route::get('/authors/{author:username}', function (User $author) {
  return view('posts', [
    'title' => "Post By Author : $author->name",
    'active' => 'posts',
    'posts' => $author->posts->load('author', 'category'),
  ]);
});*/

/*Route::get('tasks', 'App\Http\Controllers\TasksController@index');

Route::get('tasks/create', 'App\Http\Controllers\TasksController@create');
Route::post('tasks/store', 'App\Http\Controllers\TasksController@store');

Route::post('users/{user}/update-avatar', 'UpdateUserAvatar');*/
