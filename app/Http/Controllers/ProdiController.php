<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class ProdiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $prodi = Prodi::with('fakultas')->get; 
        return response()->json($prodi, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validate = $request->validate(
            [
                'nama' => 'required|unique:prodis',
                'kode' => 'required',
                'fakultas_id' => 'required|exists:fakultas,id '
            ]
        );

        $prodi = Prodi::create($validate); // simpan data
        if($prodi){
            $data['success'] = true;
            $data['message'] = "Data prodi berhasil disimpan";
            $data['data'] = $prodi;
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

        // update data fakultas
        Prodi::where('id', $id)-> update($validate);
        //mengambil data fakultas yang sudah diperbarui 
        $prodi = Prodi::find($id);
        if($prodi){
            $data['success'] = true;
            $data['message'] = "Data prodi berhasil diperbarui";
            $data['data'] = $prodi;
            return response()->json($data, 201);
        }else {
             $data['success'] = false;
            $data['message'] = "Data prodi gagal diperbarui";
            return response()->json($data, 201);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
     $prodi = Prodi::where('id', $id);
        if($prodi){
        $prodi->delete();
        $data['success'] = true;
        $data['message'] = 'prodi berhasil dihapus.';
        return response()->json($data, Response::HTTP_OK);
    }
    }
}
