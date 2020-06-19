<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ResetLoginController extends Controller
{
    public function update(User $user)
    {
        auth()->user()->profile->update(['login_attempts' => 0]);
        return;
    }
}
