<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jurusans;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jurusans = Jurusans::all();
        return response()->json($jurusans);
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
            'kode_jurusan' => 'required|string|unique:jurusans',
            'nama_jurusan' => 'required|string',
            'deskripsi_jurusan' => 'nullable|string',
        ]);

        $jurusan = Jurusans::create($request->all());

        return response()->json(['message' => 'Jurusan berhasil ditambahkan', 'data' => $jurusan], 201);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jurusan = Jurusans::findOrFail($id);
        return response()->json($jurusan);
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
        $request->validate([
            'kode_jurusan' => 'required|string',
            'nama_jurusan' => 'required|string',
            'deskripsi_jurusan' => 'nullable|string',
        ]);

        $jurusan = Jurusans::findOrFail($id);
        $jurusan->update($request->all());

        return response()->json(['message' => 'Jurusan berhasil diperbarui', 'data' => $jurusan], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jurusan = Jurusans::findOrFail($id);
        $jurusan->delete();

        return response()->json(['message' => 'Jurusan berhasil dihapus'], 200);
    }
}
