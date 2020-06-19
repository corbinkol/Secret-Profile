<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function index(User $user)
    {
        $access_granted = FALSE;
        $access_blocked = FALSE;
        $login_attempts = 0;
        return view('profiles.index', compact('user', 'access_blocked', 'login_attempts', 'access_granted'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);

        return view('profiles.edit', compact('user'));
    }

    public function update(User $user)
    {
        if (request()->has('visitor_code'))
        {
            $access_blocked = FALSE;
            $login_attempts = $user->profile->login_attempts;
            $data = request('visitor_code');
            $code = $user->profile->code;

            if ($data == $code)
            {
                $user->profile->update(['login_attempts' => 0]);
                $access_granted = TRUE;
            }
            else
            {
                $login_attempts = $login_attempts + 1;

                if ($login_attempts >= 5)
                {
                    $access_blocked = TRUE;
                    $access_granted = FALSE;
                    $user->profile->update(['login_attempts' => 0]);
                }
                else{
                    $user->profile->update(['login_attempts' => $login_attempts]);
                    $access_granted = FALSE;
                    $login_attempts = 5 - $login_attempts;
                }
            }

            return view('profiles.index', compact('user', 'access_blocked', 'login_attempts', 'access_granted' ));
        }
        else
        {
            $this->authorize('update', $user->profile);

            $data = request()->validate([
                'code' => '',
                'public_data' => '',
                'private_data' => ''
            ]);

            auth()->user()->profile->update($data);

            return redirect("/profile/{$user->id}");
        }
    }

}
