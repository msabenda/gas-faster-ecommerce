<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Login as BaseLogin;
use Illuminate\Http\RedirectResponse;

class CustomAdminLogin extends BaseLogin
{
    protected function getRedirectResponse(): RedirectResponse
    {
        return redirect()->route('filament.admin.pages.dashboard');
    }
}