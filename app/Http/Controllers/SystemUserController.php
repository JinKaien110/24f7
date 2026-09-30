<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class SystemUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $users = User::withTrashed()->get();
        return view('admin.system_users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.partials.system_users.add_modal');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'role' => 'required|string'
        ]);

        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'User created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.partials.system_users.edit_modal', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::withTrashed()->findOrFail($id);
            // Check if email is being changed
        if ($request->email == $user->email) {
            $emailRule = 'required|email';
        } else {
            $emailRule = 'required|email|unique:users,email';
        }

        // Validate the incoming request
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => [
            'required',
            'email',
            Rule::unique('users')->ignore($user->id),
        ],
            'role' => 'required|in:user,admin',
        ]);

        // Update the user
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        return redirect()->back()->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully!');
    }

    public function toggleStatus(User $user)
    {
    $user->status = $user->status === 'active' ? 'deactivated' : 'active';
    $user->save();

    return redirect()->back()->with('success', 'User status updated successfully.');
    }

    public function restore($id)
    {
    $user = User::withTrashed()->findOrFail($id);
    $user->restore();
    $user->status = 'active'; // Ensure the status is set to active
    $user->save(); // Save the changes

    return redirect()->back()->with('success', 'User restored successfully!');
    }


}
