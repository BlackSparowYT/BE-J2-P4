<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Models\Item;
use App\Models\User;
use App\Models\Category;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

if(env('SETTING_MAINTENANCE')) {
    Route::view('/', 'pages.maintenance')->name('maintenance');
}

// Normal mode

// Normal routes for site stuff
Route::group(['namespace' => 'navbar'],function() {
    Route::view('/', 'pages.home')->name('home');
    Route::view('/over-ons', 'pages.about-us')->name('about-us');
});

Route::group(['namespace' => 'navbar'],function() {
    Route::view('/contact', 'pages.contact')->name('contact');
});
Route::post('/contact', [ContactController::class, 'add'])->name('contact.add');

Route::view('/menu', 'pages.menu.menu-archive', ['items' => Item::all()])->name('menu.archive');
Route::get('/menu/{item:slug}', fn(Item $item) => view('pages.menu.menu-single', [ 'item' => $item ]))->where('item', '[a-zA-Z_\-0-9]+')->name('menu.single');



// Authentication stuff (should not be turned off with normal maintenance mode)
Route::group(['middleware' => 'guest', 'prefix'], function () {

    Route::get('/register', fn() => redirect()->route('register') );
    Route::get('/login', fn() => redirect()->route('login') );

    // Add a prefix
    Route::group(['prefix' => vel_get_account_url()], function() {

        Route::get('/register', [AuthController::class, 'register'])->name('register');
        Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');

        Route::group(['namespace' => 'guest_navbar'],function() {
            Route::get('/login', [AuthController::class, 'login'])->name('login');
        });
        Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');

    });
});

// Authenticated stuff (should not be turned off with normal maintenance mode)
Route::group(['middleware' => 'auth'], function () {

    Route::get('/dash/', fn() => redirect()->route('dashboard.main') );
    Route::get('/dashboard/', fn() => redirect()->route('dashboard.main') );

    // Add a prefix
    Route::group(['prefix' => vel_get_account_url()], function() {

        //Dashboard
        Route::group(['namespace' => 'auth_navbar'],function() {
            Route::view('/', 'pages.account.dashboard')->name('dashboard.main');
        });

        //logout
        //Route::get('/logout', [AuthController::class, 'logout'])->name('logout.get');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        // Check if user is admin
        Route::group(['middleware' => 'authAdmin'], function () {

            // Menu
            Route::view('/menu', 'pages.account.menu')->name('dashboard.menu');

            // Menu form endpoints
            Route::get( '/menu/add/',               [ItemController::class, 'create']   )->name('dashboard.menu.create');   //BE
            Route::post('/menu/add/',               [ItemController::class, 'add']      )->name('dashboard.menu.add');      //FE

            Route::get( '/menu/update/{item:slug}', [ItemController::class, 'edit']     )->name('dashboard.menu.edit');     //BE
            Route::post('/menu/update/{item:slug}', [ItemController::class, 'update']   )->name('dashboard.menu.update');   //FE

            Route::get( '/menu/delete/{item:slug}', [ItemController::class, 'trash']    )->name('dashboard.menu.trash');    //BE
            Route::post('/menu/delete/{item:slug}', [ItemController::class, 'delete']   )->name('dashboard.menu.delete');   //FE



            // Categories
            Route::view('/category', 'pages.account.categories')->name('dashboard.category');

            // Category form endpoints
            Route::get( '/category/add/',                   [CategoryController::class, 'create']   )->name('dashboard.category.create');   //BE
            Route::post('/category/add/',                   [CategoryController::class, 'add']      )->name('dashboard.category.add');      //FE

            Route::get( '/category/update/{category:slug}', [CategoryController::class, 'edit']     )->name('dashboard.category.edit');     //BE
            Route::post('/category/update/{category:slug}', [CategoryController::class, 'update']   )->name('dashboard.category.update');   //FE

            Route::post('/category/delete/{category:slug}', [CategoryController::class, 'delete']   )->name('dashboard.category.delete');   //FE
            Route::get( '/category/delete/{category:slug}', [CategoryController::class, 'trash']    )->name('dashboard.category.trash');    //BE



            // Categories
            Route::view('/users', 'pages.account.user')->name('dashboard.user');

            // Category form endpoints
            Route::get( '/users/update/{user}', [UserController::class, 'edit']     )->name('dashboard.user.edit');     //BE
            Route::post('/users/update/{user}', [UserController::class, 'update']   )->name('dashboard.user.update');   //FE

            Route::get( '/users/delete/{user}', [UserController::class, 'trash']    )->name('dashboard.user.trash');    //BE
            Route::post('/users/delete/{user}', [UserController::class, 'delete']   )->name('dashboard.user.delete');   //FE



            // Contact
            Route::view('/contact', 'pages.account.contact')->name('dashboard.contact');

            // Contact form endpoints
            Route::get( '/contact/view/{contact}',      [ContactController::class, 'view'])->name('contact.view');      //FE

            Route::post('/contact/delete/{contact}',    [ContactController::class, 'delete'])->name('contact.delete');  //BE
            Route::get( '/contact/delete/{contact}',    [ContactController::class, 'trash'])->name('contact.trash');    //FE

        });
    });
});
