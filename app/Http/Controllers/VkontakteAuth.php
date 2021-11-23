<?php

namespace App\Http\Controllers;

use App\Models\CaptureLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VkontakteAuth extends Controller
{
    public function test() {
            $newuser = User::find(1);
            Auth::login($newuser, true);
            return Auth::user()->name;
    }
}
