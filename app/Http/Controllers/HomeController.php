<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $profiles = DB::table('users')->pluck('id', 'name');
        return view('home', compact('profiles'));
    }
}
