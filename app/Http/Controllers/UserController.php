<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // Menampilkan semua data user
    public function index()
    {
        $users = User::all();
        return response()->json($users, 200); // 200 OK
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:20',
            'nama_user' => 'required|string|min:255',
            'no_hp' => '|integer|min:255',
            'ttd' => '|string|min:255',
            'role' => 'required|in:admin,wakil_ketua,wakasek,ketua_program,kepsek,guru,siswa',

        ]);

        $user = User::create($request->all());
        

        return response()->json($user, 201); // 201 Created
    }

    // Menampilkan detail user berdasarkan ID
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user, 200); // 200 OK
    }

    // Memperbarui data user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'string|max:255',
            'email' => 'email|unique:users,email,' . $id,
            'password' => 'string|min:6',
        ]);

        $user->update($request->all());

        return response()->json($user, 200); // 200 OK
    }

    // Menghapus data user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(null, 204); // 204 No Content
    }


}
