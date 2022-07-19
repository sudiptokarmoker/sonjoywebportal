<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backened\DashboardController;
use App\Http\Controllers\Backened\Auth\LoginController;
use App\Http\Controllers\Backened\Auth\ForgotPasswordController;
use App\Http\Controllers\Backened\GroupController;
use App\Http\Controllers\Backened\PermissionController;
use App\Http\Controllers\Backened\RolesController;
use App\Http\Controllers\Backened\UsersController;
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


Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.home')->middleware('auth');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard')->middleware('auth');
    /**
     * login / signup related
     */
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');
    Route::post('/login/submit', [LoginController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout/submit', [LoginController::class, 'logout'])->name('admin.logout.submit');
    Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('admin.password.request')->middleware('auth');
    Route::get('/password/reset/submit', [ForgotPasswordController::class, 'reset'])->name('admin.password.update')->middleware('auth');
    /**
     * forget password related
     */
    Route::get('/forget-password', [\App\Http\Controllers\Backened\PasswordController::class, 'generatePasswordResetForm'])->name('admin.password.forget');
    Route::post('/forget-password-processing', [\App\Http\Controllers\Backened\PasswordController::class, 'forgetPasswordEmailHandler'])->name('admin.password.forget.submit');
    Route::get('/forget-password-reset-new', [\App\Http\Controllers\Backened\PasswordController::class, 'resetNewPassword'])->name('admin.password.forget.reset.new');
    Route::post('/new-password-process', [\App\Http\Controllers\Backened\PasswordController::class, 'newPasswordProcess'])->name('admin.new.password.process');

    Route::resource('permission', PermissionController::class, ['name' => 'admin.permission'])->middleware('auth');
    Route::resource('group', GroupController::class, ['name' => 'admin.group'])->middleware('auth');
    Route::resource('roles', RolesController::class, ['name' => 'admin.roles'])->middleware('auth');
    Route::post('roles/multiple_request_submit', [RolesController::class, 'multiple_role_submit'])->name('admin.roles.multiple.create');

    Route::resource('users', UsersController::class, ['name' => 'admin.users'])->middleware('auth');
    /**
     * Account settings
     */
    Route::get('/account-settings', [DashboardController::class, 'accountSettings'])->name('admin.home.account.settings');
    Route::post('/account-settings-submit', [DashboardController::class, 'accountSettingsSubmitForm'])->name('admin.home.account.settings.submit');
    
    Route::get('restore_user', [UsersController::class, 'restore_user'])->name('users.restore')->middleware('auth');
    Route::get('users/restore_user_process/{id}', [UsersController::class, 'restore_user_process'])->name('users.restore_user_process')->middleware('auth');

    Route::get('users_all', [UsersController::class, 'allUser'])->name('users.lists.all')->middleware('auth');
    Route::get('users/destroy_by_hard_delete/{id}', [UsersController::class, 'destroy_by_hard_delete'])->name('users.destroy_by_hard_delete')->middleware('auth');
});
