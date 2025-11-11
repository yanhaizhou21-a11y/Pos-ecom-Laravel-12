<?php

use App\Livewire\Customers\ListCustomers;
use App\Livewire\Items\ListInventories;
use App\Livewire\Items\ListItems;
use App\Livewire\Management\ListPaymentMethod;
use App\Livewire\Management\ListUsers;
use App\Livewire\Sales\ListSales;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use League\CommonMark\Extension\CommonMark\Node\Block\ListItem;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});
Route::middleware(['auth'])->group(function () {   
    Route::get('/management-users',ListUsers::class)->name('users.index');
    Route::get('/management-items',ListItems::class)->name('items.index');
    Route::get('/edit-items/{record}',ListItems::class)->name('item.update');
    Route::get('/management-inventories',ListInventories::class)->name('inventories.index');
    Route::get('/management-sales',ListSales::class)->name('sales.index');
    Route::get('/management-customers',ListCustomers::class)->name('customers.index');
    Route::get('/management-payment-method',ListPaymentMethod::class)->name('payment.method.index');

    });

 