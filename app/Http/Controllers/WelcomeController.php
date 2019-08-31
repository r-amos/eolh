<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        if ($request->user()) {
            return redirect('home');
        }
        return view('welcome');
    }
}
