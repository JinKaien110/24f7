<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
Use App\Models\User;

class UserViewController extends Controller
{
    public function view(Request $request) {
        $user = Auth::user();

        return view('layouts.user.store-locator', compact('user'));
    }
}
