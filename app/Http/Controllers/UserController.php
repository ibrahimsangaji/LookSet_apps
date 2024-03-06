<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('catalog.User', ['users' => $users]);
    }

    public function create()
    {
        return view('create.createUser');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'role' => 'required|in:admin,staff,supervisor',
        ]);

        $existingUser = User::where('email', $validatedData['email'])->first();

        if ($existingUser) {
            return redirect('/catalog/user')->with('error', 'User with the same email already exists!');
        }

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect('/catalog/user')->with('success', 'User added successfully!');
    }

    public function edit(User $user)
    {
        return view('edit.editUser', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:6',
        ]);

        if (isset($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        $user->update($validatedData);

        return redirect('/catalog/user')->with('success', 'User updated successfully!');
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();
        return redirect('/catalog/user')->with('success', 'User deleted successfully!');
        } catch (QueryException $e) {
            // Menggunakan kode SQLSTATE[23000] untuk mendeteksi kesalahan referensi kunci asing
            if ($e->getCode() == '23000') {
                return redirect('/catalog/user')->with('error', 'Cannot erase client. Since client information is still utilized.');
            } else {
                // Tangani kesalahan lainnya
                return redirect('/catalog/user')->with('error', 'Error deleting the user.');
            }
        }
    }
}
