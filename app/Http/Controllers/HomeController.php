<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Redirect to tesones index.
     */
    public function index(): RedirectResponse
    {
        return redirect()->route('tesones.index');
    }
}
