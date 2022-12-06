<?php

use App\Http\Controllers\AirlineController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\RegtypeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\SaleVendorController;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
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
Auth::routes();
Auth::routes(['register' => false]);
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::resource('tickets', TicketController::class);
    Route::get('tickets/type/{type}', [TicketController::class,'ticket_type'])->name('tickets.ticket_type');
    Route::get('tickets/all/dues', [TicketController::class,'ticket_due'])->name('tickets.all.due');
    Route::get('tickets/delete/{id}', [TicketController::class,'destroy'])->name('tickets.delete');
    Route::post('tickets/details', [TicketController::class,'details'])->name('ticket.details');
    Route::post('dou/paid/model/show', [TicketController::class,'due_paid_model'])->name('douPaid.model.show');
    Route::post('tickets/paid/due', [TicketController::class,'due_paid'])->name('ticket.dou.paid');
    Route::get('report/authot', [ReportController::class,'authot'])->name('report.authot');
    Route::get('report/profit-loss', [ReportController::class,'profitloss'])->name('report.profit-loss');
    Route::get('report/branch', [ReportController::class,'branch'])->name('report.branch');
    Route::get('report/branch/{id}', [ReportController::class,'branch_details'])->name('report.branch.details');
    //mail Send
    Route::post('mail/send', [HomeController::class, 'send_mail'])->name('mail.send');
    Route::post('send/sms', [HomeController::class, 'send_sms'])->name('send.sms');
    Route::view('messages', 'messages.create')->name('messages.create');
});

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::resource('branchs', BranchController::class);
    Route::get('branchs/delete/{id}', [BranchController::class,'destroy'])->name('branchs.delete');
    Route::resource('user', UserController::class);
    Route::get('user/delete/{id}', [UserController::class,'destroy'])->name('user.delete');
    Route::resource('airlines', AirlineController::class);
    Route::get('airlines/delete/{id}', [AirlineController::class,'destroy'])->name('airlines.delete');
    Route::resource('sector', SectorController::class);
    Route::get('sector/delete/{id}', [SectorController::class,'destroy'])->name('sector.delete');
    //Reg Type
    Route::resource('regtype', RegtypeController::class);
    Route::get('regtype/delete/{id}', [RegtypeController::class,'destroy'])->name('regtype.delete');
    // Link
    Route::resource('links', LinkController::class);
    Route::get('links/delete/{id}', [LinkController::class,'destroy'])->name('links.delete');
    //Salary
    Route::resource('salary', SalaryController::class);
    Route::get('salary/delete/{id}', [SalaryController::class,'destroy'])->name('salary.delete');
    //Banks
    Route::resource('banks', BankController::class);
    Route::get('banks/delete/{id}', [BankController::class,'destroy'])->name('banks.delete');
    Route::post('banks/branch', [BankController::class,'blanchUpdate'])->name('bank.balach');
    Route::post('bank/transfor/model', [BankController::class,'bank_transfor'])->name('bank_transfor.model.show');
    Route::post('bank/transfor/update', [BankController::class,'bank_transfor_update'])->name('bank_transfor.update');
});

Route::group(['middleware' => ['auth']], function () {
    Route::resource('vendors', VendorController::class);
    Route::get('vendors/delete/{id}', [VendorController::class,'destroy'])->name('vendors.delete');
    Route::post('vendors/paynow', [VendorController::class,'paynow'])->name('vendors.paynow');
    Route::get('vendors/paymetn/history/{id}', [VendorController::class,'payemntHistory'])->name('vendor.payment.history');
    Route::get('vendors/paymetn/history/delete/{id}', [VendorController::class,'deletePaymentHustory'])->name('vendor.payment.history.delete');
    Route::get('vendors/due/print/{id}', [VendorController::class,'print'])->name('vendor.due.print');
    //Sale Vendors
    Route::resource('salevendor', SaleVendorController::class);
    Route::get('salevendor/delete/{id}', [SaleVendorController::class,'destroy'])->name('salevendor.delete');
    Route::post('salevendor/branch', [SaleVendorController::class,'blanchUpdate'])->name('salevendor.balach');
    Route::get('salevendor/new/register/{id}', [SaleVendorController::class,'register'])->name('salevendor.register');
    Route::get('salevendor/paymetn-history/{id}', [SaleVendorController::class,'paymetnhistory'])->name('salevendor.paymetn-history');
    Route::get('salevendor/due/print/{id}', [SaleVendorController::class,'print'])->name('salevendor.due.print');
});
