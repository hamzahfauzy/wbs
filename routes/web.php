<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\OtpAuthController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Controllers\Admin\PengaduanController;
use App\Http\Controllers\Admin\NotifEventController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Pengawas\DashboardController as PengawasDashboardController;
use App\Http\Controllers\Pengawas\PengaduanController as PengawasPengaduanController;
use App\Models\Faq;

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

Route::middleware('jwt_middleware')->group(function () {

    Route::get('/', function () {
        $faqs = Faq::orderby('order_number')->get();
        return view('welcome', compact('faqs'));
    });

    Route::prefix('otp')->name('otp.')->group(function () {
        Route::get('/', [OtpAuthController::class, 'index'])->name('index');
        Route::post('send', [OtpAuthController::class, 'send'])->name('send');
        Route::post('verified', [OtpAuthController::class, 'verified'])->name('verified');
    });

    Route::prefix('guest')->name('guest.')->group(function () {
        Route::get('/', [GuestController::class, 'index'])->name('index');
        Route::middleware('otp_auth')->group(function () {
            Route::get('/', [GuestController::class, 'index'])->name('index');
            Route::get('create', [GuestController::class, 'create'])->name('create');
            Route::post('store', [GuestController::class, 'store'])->name('store');
            Route::post('send-msg/{pengaduan}', [GuestController::class, 'sendMsg'])->name('send-msg');
            Route::get('conversation/{pengaduan}', [GuestController::class, 'conversation'])->name('conversation');
            Route::get('show/{pengaduan}', [GuestController::class, 'show'])->name('show');
        });

        // otp
        Route::get('message-content/{pengaduan_id}',function(Pengaduan $pengaduan){
            
        })->name('message-content');
    });

    Route::middleware('jwt_auth')->group(function () {
        Route::get('message-content/{pengaduan_id}',function(){

        })->name('message-content');

        Route::get('/logout',function(){
            \Cookie::forget('labura_layanan_app_token');
            return redirect()->to('https://layanan.labura.go.id');
        })->name('logout');
        Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
            Route::get('/', [AdminDashboardController::class, 'index'])->name('index');
            Route::get('pengaduan/{pengaduan}/update-status/{status}', [PengaduanController::class,'updateStatus'])->name('pengaduan.update-status');
            Route::resource('pengaduan', PengaduanController::class);
            Route::get('pengguna/{user}/delete', [PenggunaController::class, 'delete'])->name('pengguna.delete');
            Route::resource('pengguna', PenggunaController::class);
            Route::get('faq/{faq}/delete',[FaqController::class,'delete'])->name('faq.delete');
            Route::resource('faq', FaqController::class);
            Route::match(['get','post'],'notif', [NotifEventController::class,'index'])->name('notif.index');

            Route::post('send-msg/{pengaduan}', [AdminDashboardController::class, 'sendMsg'])->name('send-msg');
            Route::get('conversation/{pengaduan}', [AdminDashboardController::class, 'conversation'])->name('conversation');
            // Route::resource('notif', NotifEventController::class);
        });

        Route::middleware('pengawas')->prefix('pengawas')->name('pengawas.')->group(function () {
            Route::get('/', [PengawasDashboardController::class, 'index'])->name('index');
            Route::post('send-msg/{pengaduan}', [PengawasDashboardController::class, 'sendMsg'])->name('send-msg');
            Route::get('conversation/{pengaduan}', [PengawasDashboardController::class, 'conversation'])->name('conversation');

            Route::get('pengaduan/{pengaduan}/update-status/{status}', [PengawasPengaduanController::class, 'updateStatus'])->name('pengaduan.update-status');
            Route::resource('pengaduan', PengawasPengaduanController::class);
        });
    });
});
