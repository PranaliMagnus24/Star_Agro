<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
class LanguageController extends Controller
{
    public function switchLanguage($lang)
    {
        $availableLocales = ['en', 'mr', 'hi'];
        if (in_array($lang, $availableLocales)) {
            session(['app_locale' => $lang]);
            App::setLocale($lang);
            \Log::info('Language switched to: ' . $lang);
        }
        return redirect()->back();
    }
}
