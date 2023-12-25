<?php

use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Bus\Batch;

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

//Route::get('/test', function (){
//    return view('admin.dashboard-new');
//});

Route::get('/mail/template', function (){
   return view('mail.order-ship', [
       'name' => 'Eko',
       'created_at' => now(),
       'id' => 2,
   ]);
});

Route::get('/mail/send', function (){
    $faker = \Faker\Factory::create('en_EN');

    $cart = \App\Models\Cart::find(102);

    for ($i = 0; $i < 2; $i++) {
        $emails[] = $faker->safeEmail;
    }

    try {
        foreach ($emails as $email){
            \App\Jobs\SendNotifEmailJob::dispatch($email, 'Test', now(), 12);

//            Mail::to($email)->send(new OrderShipped('Test', now(), 12));
        }
    }catch (\Exception $e){
        var_dump($e->getMessage());
    }
});

Route::get('/api/chart/{year}', [\App\Http\Controllers\ApiController::class, 'chartMonthly']);
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
Route::get('/book/detail/{id}', [\App\Http\Controllers\HomeController::class, 'detailBook'])
    ->name('book.detail');
Route::get('/dashboard', [\App\Http\Controllers\HomeController::class, 'dashboard']);

Route::middleware(\App\Http\Middleware\MustNotLoginMiddleware::class)->group(function (){
    Route::get('/login', [\App\Http\Controllers\HomeController::class, 'login'])
        ->name('member.login');
    Route::post('/login', [\App\Http\Controllers\HomeController::class, 'doLogin']);

    Route::get('/admin/login', [\App\Http\Controllers\AdminController::class, 'login']);
    Route::post('/admin/login', [\App\Http\Controllers\AdminController::class, 'doLogin']);

    Route::get('/register', [\App\Http\Controllers\HomeController::class, 'register'])->name('register');
    Route::post('/register', [\App\Http\Controllers\HomeController::class, 'doRegister'])->name('register.store');

    Route::get('reset-password', [\App\Http\Controllers\ResetPasswordController::class, 'index'])->name('reset-password');
    Route::post('reset-password', [\App\Http\Controllers\ResetPasswordController::class, 'store'])->name('reset-password.store');

    Route::get('confirm-password', [\App\Http\Controllers\ConfirmResetPasswordController::class, 'index'])->name('confirm-reset.index');
    Route::post('confirm-password', [\App\Http\Controllers\ConfirmResetPasswordController::class, 'store'])->name('confirm-reset.store');;
});

Route::middleware(\App\Http\Middleware\MemberMiddleware::class)->group(function (){
    Route::post('/member/logout/{id}', [\App\Http\Controllers\MemberController::class, 'doLogout'])->name('member.logout');
    Route::get('/cart', [\App\Http\Controllers\MemberController::class, 'editCart']);
    Route::get('/cart/detail', [\App\Http\Controllers\MemberController::class, 'cartDetail'])
        ->name('cart.detail');
    Route::post('/cart/delete/{id}', [\App\Http\Controllers\MemberController::class, 'deleteFromCart'])
        ->name('cart.delete');
    Route::post('/cart/checkout', [\App\Http\Controllers\MemberController::class, 'checkout'])
        ->name('cart.checkout');

    Route::get('/history', [\App\Http\Controllers\MemberController::class,  'history'])->name('history.index');

});


Route::middleware(\App\Http\Middleware\AdminMiddleware::class)->group(function (){
    Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/add/book', [\App\Http\Controllers\AdminController::class, 'addBook'])->name('admin.add-book');
    Route::post('/admin/add/book', [\App\Http\Controllers\AdminController::class, 'doAddBook'])->name('admin.do-add-book');
    Route::get('/admin/add/member', [\App\Http\Controllers\AdminController::class, 'addMember'])->name('admin.add-member');
    Route::post('/admin/add/member', [\App\Http\Controllers\AdminController::class, 'doAddMember'])->name('admin.do-add-member');
    Route::get('/admin/members', [\App\Http\Controllers\AdminController::class, 'member'])->name('admin.all-member');
    Route::post('/admin/logout', [\App\Http\Controllers\AdminController::class, 'doLogout'])->name('admin.logout');

    Route::post('/book/destroy', [\App\Http\Controllers\AdminController::class, 'destroyBook'])->name('book.destroy');
    Route::get('/book/update/{id}', [\App\Http\Controllers\AdminController::class, 'updateBook'])->name('book.update');
    Route::post('/book/update/{id}', [\App\Http\Controllers\AdminController::class, 'doUpdateBook'])->name('book.update.store');

    Route::get('/admin/confirm', [\App\Http\Controllers\AdminController::class, 'confirmCart'])->name('admin.confirm');
    Route::get('/admin/confirm/{cart}', [\App\Http\Controllers\AdminController::class, 'confirm'])->name('admin.confirmCart');


    Route::post('/confirm/{cart}', [\App\Http\Controllers\AdminController::class, 'doConfirm']);

    Route::get('/admin/return', [\App\Http\Controllers\AdminController::class, 'confirmList'])->name('admin.return');
    Route::get('/admin/return/{cart}', [\App\Http\Controllers\AdminController::class, 'cartDetail'])
        ->name('admin.cart.detail');
    Route::post('/admin/return/{cart}', [\App\Http\Controllers\AdminController::class, 'cartDetailStore'])
        ->name('admin.cart.detail.store');

    Route::get('/admin/books', [\App\Http\Controllers\AdminController::class, 'books'])->name('admin.books');
    Route::get('/admin/chart', [\App\Http\Controllers\AdminController::class, 'chart'])
    ->name('admin.chart');
});
