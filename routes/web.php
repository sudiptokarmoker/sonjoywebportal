<?php

use App\Http\Controllers\Backened\ArtistsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backened\DashboardController;
use App\Http\Controllers\Backened\Auth\LoginController;
use App\Http\Controllers\Backened\Auth\ForgotPasswordController;
use App\Http\Controllers\Backened\ComposerController;
use App\Http\Controllers\Backened\GroupController;
use App\Http\Controllers\Backened\PermissionController;
use App\Http\Controllers\Backened\PostsCategoryAllGeneralController;
use App\Http\Controllers\Backened\PostsCategoryController;
use App\Http\Controllers\Backened\RolesController;
use App\Http\Controllers\Backened\SongsCategoryController;
use App\Http\Controllers\Backened\SongsController;

use App\Http\Controllers\Backened\VersesCategoryController;
use App\Http\Controllers\Backened\VersesController;

use App\Http\Controllers\Backened\NovelsController;

use App\Http\Controllers\Backened\UsersController;
use App\Http\Controllers\TestController;

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
Route::redirect('/', '/admin');
/**
 * open route for admin dashboard
 */
Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::get('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');
Route::post('/admin/login/submit', [LoginController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout/submit', [LoginController::class, 'logout'])->name('admin.logout.submit');
Route::get('/admin/forget-password', [\App\Http\Controllers\Backened\PasswordController::class, 'generatePasswordResetForm'])->name('admin.password.forget');
Route::post('/admin/forget-password-processing', [\App\Http\Controllers\Backened\PasswordController::class, 'forgetPasswordEmailHandler'])->name('admin.password.forget.submit');
Route::get('/admin/forget-password-reset-new', [\App\Http\Controllers\Backened\PasswordController::class, 'resetNewPassword'])->name('admin.password.forget.reset.new');
Route::post('/admin/new-password-process', [\App\Http\Controllers\Backened\PasswordController::class, 'newPasswordProcess'])->name('admin.new.password.process');
/**
 * group prfix for admin route with auth middleware check
 */
Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.home');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    /**
     * login / signup related
     */
    Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('admin.password.request');
    Route::get('/password/reset/submit', [ForgotPasswordController::class, 'reset'])->name('admin.password.update');
    /**
     * forget password related
     */
    Route::resource('permission', PermissionController::class, ['name' => 'admin.permission']);
    Route::resource('group', GroupController::class, ['name' => 'admin.group']);
    Route::resource('roles', RolesController::class, ['name' => 'admin.roles']);
    Route::post('roles/multiple_request_submit', [RolesController::class, 'multiple_role_submit'])->name('admin.roles.multiple.create');

    Route::resource('users', UsersController::class, ['name' => 'admin.users']);
    /**
     * Account settings
     */
    Route::get('/account-settings', [DashboardController::class, 'accountSettings'])->name('admin.home.account.settings');
    Route::post('/account-settings-submit', [DashboardController::class, 'accountSettingsSubmitForm'])->name('admin.home.account.settings.submit');
    
    Route::get('restore_user', [UsersController::class, 'restore_user'])->name('users.restore');
    Route::get('users/restore_user_process/{id}', [UsersController::class, 'restore_user_process'])->name('users.restore_user_process');

    Route::get('users_all', [UsersController::class, 'allUser'])->name('users.lists.all');
    Route::get('users/destroy_by_hard_delete/{id}', [UsersController::class, 'destroy_by_hard_delete'])->name('users.destroy_by_hard_delete');

    Route::resource('posts_category', PostsCategoryController::class, ['name' => 'admin.posts_category']);
    Route::get('category-lists-all', [PostsCategoryController::class, 'allCatetoryLists'])->name('posts_category.lists.all');
    // posts category all general
    Route::resource('posts_category_all_general', PostsCategoryAllGeneralController::class, ['name' => 'admin.posts_category_all_general']);
    // artists
    Route::resource('artists', ArtistsController::class, ['name' => 'admin.artists']);
    Route::get('artists_all', [ArtistsController::class, 'allArtists'])->name('artists.lists.all');
    // composer
    Route::resource('composer', ComposerController::class, ['name' => 'admin.composer']);
    Route::get('composer_all', [ComposerController::class, 'allComposer'])->name('composer.lists.all');
    // songs module
    Route::resource('songs_category', SongsCategoryController::class, ['name' => 'admin.songs_category']);
    Route::get('songs-category-lists-all', [SongsCategoryController::class, 'allSongsCatetoryLists'])->name('songs_category.lists.all');
    Route::resource('songs', SongsController::class, ['name' => 'admin.songs']);
    Route::get('songs_all', [SongsController::class, 'allSongs'])->name('songs.lists.all');

    // songs module
    Route::resource('verses_category', VersesCategoryController::class, ['name' => 'admin.verses_category']);
    Route::get('verses-category-lists-all', [VersesCategoryController::class, 'allVersesCatetoryLists'])->name('verses_category.lists.all');
    Route::resource('verses', VersesController::class, ['name' => 'admin.songs']);
    Route::get('verses_all', [VersesController::class, 'allVerses'])->name('verses.lists.all');

    // novels
    Route::resource('novels', NovelsController::class, ['name' => 'admin.songs']);
    Route::get('novels_all', [NovelsController::class, 'allNovels'])->name('novels.lists.all');
});
Route::get('test', [TestController::class, 'index']);