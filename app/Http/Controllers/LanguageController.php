<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switchLanguage($lang)
    {
        // Store selected language in session
        Session::put('locale', $lang);

        // dd($lang);

        // Set application locale
        App::setLocale($lang);

        return Redirect::back(); // Redirect back to the same page
    }
}
