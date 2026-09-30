<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Faces\View;

class ReactivationController extends Controller
{
    

    public function show($id) {
        $user = User::withTrashed()->findOrFail($id);

        if ($user->withTrashed() || $user->status == 'deactivated') {
            return view('archive.index', compact('user'));
        }

        elseif ($user->status == 'active') { 
            return redirect()->route('UserDashboard'); 
        }
        
    }

    public function reactivate($id) {
        $user = User::withTrashed()->findOrFail($id);
        if (!$user->withTrashed() || $user->status == 'active') {
            return redirect()->route('UserDashboard');
        }
        
        $user->restore();
        $user->status = 'active';
        $user->save();
        Auth::login($user);
        
        return redirect()->route('UserDashboard')->with('success', 'Your account has been reactivated');

    }
}
