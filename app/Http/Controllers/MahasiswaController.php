<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MahasiswaController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $mahasiswa = Mahasiswa::with('prodi.fakultas')->get(); 
        return response()->json($mahasiswa, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validate = $request->validate(
            [
                'nama' => 'required|unique:mahasiswa',
                'kode' => 'required'
                
            ]
        );

        $mahasiswa = Mahasiswa::create($validate); // simpan data
        if($mahasiswa){
            $data['success'] = true;
            $data['message'] = "Data mahasiswa berhasil disimpan";
            $data['data'] = $mahasiswa;
            return response()->json($data, 201);
        };
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

         $validate = $request->validate(
            [
                'nama' => 'required',
                'kode' => 'required'
            ]
        );

        // update data mahasiswa
        Mahasiswa::where('id', $id)-> update($validate);
        //mengambil data mahasiswa yang sudah diperbarui 
        $mahasiswa = Mahasiswa::find($id);
        if($mahasiswa){
            $data['success'] = true;
            $data['message'] = "Data mahasiswa berhasil diperbarui";
            $data['data'] = $mahasiswa;
            return response()->json($data, 201);
        }else {
             $data['success'] = false;
            $data['message'] = "Data mahasiswa gagal diperbarui";
            return response()->json($data, 201);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mahasiswa = Mahasiswa::where('id', $id);
    if($mahasiswa){
        $mahasiswa->delete();
        $data['success'] = true;
        $data['message'] = 'Mahasiswa berhasil dihapus.';
        return response()->json($data, Response::HTTP_OK);
    }
    }
}
