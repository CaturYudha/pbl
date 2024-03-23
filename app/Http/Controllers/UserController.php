<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users',
            'password' => 'required|string|min:6',
            'nama_user' => 'required|string',
            'no_hp' => 'nullable|string',
            'ttd' => 'nullable|image|mimes:png|max:2048', // Format PNG, maksimum ukuran 2MB
            'role' => 'required|string|in:admin,sarpras,ketua_program,kepsek,guru,siswa',
        ]);

        $data = $request->all();
        

        // Jika ada file gambar yang diunggah
        if ($request->hasFile('ttd')) {
            // Simpan gambar ke direktori yang telah ditentukan
            $file = $request->file('ttd');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = '/uploads/ttd/' . $fileName;
            $file->move(public_path('uploads/ttd'), $fileName);

            // Simpan path penyimpanan gambar di dalam kolom 'ttd' di database
            $data['ttd'] = $filePath;
        }

        // Simpan data user ke dalam database
        $user = User::create($data);
        $user->update($request->except('ttd'));


        return response()->json(['message' => 'Data user berhasil ditambahkan', 'user' => $user], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    $request->validate([
        'username' => 'required|string',
        'password' => 'required|string|min:6',
        'nama_user' => 'required|string',
        'no_hp' => 'nullable|string',
        'ttd' => 'nullable|image|mimes:png|max:2048',
        'role' => 'required|string|in:admin,sarpras,ketua_program,kepsek,guru,siswa',
    ]);

    // Jika ada perubahan pada gambar tanda tangan
    if ($request->hasFile('ttd')) {
        $file = $request->file('ttd');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = '/uploads/ttd/' . $fileName;
        $file->move(public_path('uploads/ttd'), $fileName);

        // Hapus gambar tanda tangan yang lama (jika ada)
        if ($user->ttd && file_exists(public_path($user->ttd))) {
            unlink(public_path($user->ttd));
        }

        // Simpan path gambar tanda tangan yang baru di database
        $user->ttd = $filePath;
    }

    // Update data user
    $user->update($request->all());

    return response()->json(['message' => 'Data user berhasil diperbarui', 'user' => $user], 200);
}




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        if ($user) {
            return response()->json(['message' => 'Data user berhasil dihapus'], 200);
        } else {
            return response()->json(['message' => 'Gagal menghapus data user'], 400);
        }
    }
}