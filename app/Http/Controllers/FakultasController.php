<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class FakultasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fakultas = Fakultas::all(); // seletc * from fakultas
        return response()->json($fakultas, 200);
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
                'nama' => 'required|unique:fakultas',
                'kode' => 'required'
            ]
        );

        $fakultas = Fakultas::create($validate); // simpan data
        if($fakultas){
            $data['success'] = true;
            $data['message'] = "Data fakultas berhasil disimpan";
            $data['data'] = $fakultas;
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
        Fakultas::where('id', $id)-> update($validate);
        //mengambil data fakultas yang sudah diperbarui 
        $fakultas = Fakultas::find($id);
        if($fakultas){
            $data['success'] = true;
            $data['message'] = "Data fakultas berhasil diperbarui";
            $data['data'] = $fakultas;
            return response()->json($data, 201);
        }else {
             $data['success'] = false;
            $data['message'] = "Data fakultas gagal diperbarui";
            return response()->json($data, 201);
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
    $fakultas = Fakultas::where('id', $id);
    if($fakultas){
        $fakultas->delete();
        $data['success'] = true;
        $data['message'] = 'Fakultas berhasil dihapus.';
        return response()->json($data, Response::HTTP_OK);
    }
}  
}