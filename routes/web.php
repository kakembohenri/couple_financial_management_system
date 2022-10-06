<?php

/*namespace App/Http/Controllers/Auth;*/

use App\Http\Controllers\AccountsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\DashboardController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\BillsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserPostController;

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
    return view('home');
})->name('/');


// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/dashboard', [DashboardController::class, 'invite']);
Route::get('/accept-invitation', [DashboardController::class, 'accept_invitation'])->name('accept.invite');

// Auth
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'create_account']);
Route::get('/create-profile', [RegisterController::class, 'create_profile'])->name('create-profile');
Route::post('/create-profile', [RegisterController::class, 'fill_profile'])->name('create-profile');
Route::get('/verify-email/{email}/{token}', [RegisterController::class, 'verify'])->name('email.verify');

// Login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Forgot password
Route::get('/forgot-password', [LoginController::class, 'forgot_password'])->name('forgot-password');
Route::post('/forgot-password', [LoginController::class, 'send_token']);
Route::get('/check-credentials/{email}/{token}', [LoginController::class, 'check_credentials'])->name('password.reset');

// Reset Password
Route::get('/reset-password', [LoginController::class, 'reset_password'])->name('reset-password');
Route::post('/reset-password', [LoginController::class, 'new_password']);

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

// Profile
Route::get('/profile/{name}', [ProfileController::class, 'index'])->name('profile');
Route::get('/change-password', [ProfileController::class, 'change_password'])->name('change-password');
Route::post('/change-password', [ProfileController::class, 'update_password']);
Route::post('/profile/{name}', [ProfileController::class, 'update']);

// Tips
Route::get('/tips/how-to-use', function () {
    return view('tips.manual');
})->name('manual');

Route::get('/tips/faqs', function () {
    return view('tips.faqs');
})->name('faqs');

// Bills
Route::get('/bills/{name}/add-invoice', [BillsController::class, 'add_invoice'])->name('add.invoice');
Route::post('/bills/{name}/add-invoice', [BillsController::class, 'create_invoice']);
Route::get('/bills/{name}', [BillsController::class, 'index'])->name('bills');
Route::get('/bill/create', [BillsController::class, 'create'])->name('add.bill');
Route::get("bills/edit/{name}/{id}/{paid}", [BillsController::class, 'edit'])->name('edit.invoice');
Route::post("bills/edit", [BillsController::class, 'post_edit'])->name('store.edit');

// Accounts
Route::get('/accounts/{name}', [AccountsController::class, 'index'])->name('account');
Route::get('/add/accounts/{name}', [AccountsController::class, 'add'])->name('accounts.add');
Route::post('/add/accounts/{name}', [AccountsController::class, 'create_account']);
Route::post('/accounts/delete/{id}', [AccountsController::class, 'delete_account'])->name('delete.account');
Route::get('/add_savings/{id}', [AccountsController::class, 'add_savings'])->name('add.saving');
Route::post('/add_savings/{id}', [AccountsController::class, 'new_saving']);

// Messages
Route::get('/messages', [MessagesController::class, 'index'])->name('inbox');
Route::post('/messages', [MessagesController::class, 'send']);


// Admin //
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/my-profile', [AdminController::class, 'get_profile'])->name('admin.profile');
Route::post('/admin/my-profile', [AdminController::class, 'store']);
Route::get('/admin/manage-user', [AdminController::class, 'manage'])->name('admin.manage');
Route::post('/admin/manage-user', [AdminController::class, 'del_user']);
Route::get('/admin/create-profile', [AdminController::class, 'get_create'])->name('admin.create');
Route::post('/admin/create-profile', [AdminController::class, 'create_profile']);


// Budget
Route::get('/paid-expenditures', [DashboardController::class, 'paid'])->name('paid');
Route::get('/unpaid-expenditures', [DashboardController::class, 'unpaid'])->name('unpaid');
Route::get('/report', [DashboardController::class, 'report'])->name('report');
Route::get('/print-report', [DashboardController::class, 'print'])->name('pdf');
// Route::get('/print', [DashboardController::class, 'print_pdf'])->name('pdf');

// Expenses
Route::get('/activity', [DashboardController::class, 'activity'])->name('activity');
Route::get('/upcoming', [DashboardController::class, 'upcoming'])->name('upcoming');
