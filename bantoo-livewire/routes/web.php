<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;

Route::get('/', LandingPageController::class)->name('landing');

Route::middleware(['auth'])->group(function () {
  Route::redirect('settings', 'settings/profile');

  Route::get('settings/profile', Profile::class)->name('settings.profile');
  Route::get('settings/password', Password::class)->name('settings.password');
  Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

Route::middleware(['auth', 'verified'])->group(function () {
  Route::view('/home', 'home')->name('home');
  Route::view('/campaign/new', 'campaign.create')->name('campaign.create');
  Route::view('/campaign/view/{id}', 'home')->name('campaign.view');
});

require __DIR__.'/auth.php';
