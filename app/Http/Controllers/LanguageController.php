<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class LanguageController extends Controller
{
    public function switch(string $locale): RedirectResponse
    {
        // Validate locale
        if (!in_array($locale, ['en', 'ro', 'ru'])) {
            $locale = 'en';
        }

        session(['locale' => $locale]);
        
        return redirect()->back();
    }
}
