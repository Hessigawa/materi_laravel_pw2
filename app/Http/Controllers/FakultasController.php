<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controller as RoutingController;

class FakultasController extends RoutingController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fakultas = Fakultas::all();
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

        $fakultas = Fakultas::create($validate);
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

         $fakultas = Fakultas::find($id);
         if ($fakultas) {
             $validate = $request->validate(
            [
                'nama' => 'required|unique:fakultas',
                'kode' => 'required'
            ]
            );

        Fakultas::where('id', $id)->update($validate);
       
        if($fakultas){
            $data['success'] = true;
            $data['message'] = "Data fakultas berhasil diperbarui";
            $data['data'] = $fakultas;
            return response()->json($data, 200);
            };

        }else{
            $data['success'] = false;
            $data['message'] = "Data fakultas tidak di temukan";
            return response()->json($data, 200);
        }
        

        

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
         $fakultas = Fakultas::find($id);

         if($fakultas){
            $fakultas->delete();
            $data['success'] = true;
            $data['message'] = "Data fakultas berhasil dihapus";
            return response()->json($data, Response::HTTP_OK);
        }else{
            $data['success'] = false;
            $data['message'] = "Data fakultas tidak di temukan";
            return response()->json($data, Response::HTTP_NOT_FOUND);
        }

    }
}