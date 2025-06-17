<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Tampilkan halaman about.
     */
    public function about()
    {
        return view('about'); // resources/views/about.blade.php
    }

    /**
     * Tampilkan halaman contact.
     */
    public function contact()
    {
        return view('contact'); // resources/views/contact.blade.php
    }
}
