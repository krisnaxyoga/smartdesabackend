<?php

namespace App\Http\Controllers\Api;

use App\Artikel;
use App\Http\Controllers\Controller;
use App\KategoriArtikel;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Artikel::with('kategori')->orderBy('created_at', 'DESC');

        $desaId = $request->header('DesaId');
        

        if($desaId != NULL && $desaId != "") {
            $data->where('desa_id',$desaId);
        } 

        if (isset($request->category_id)) {
            $data = $data->where('kategori_artikel_id', $request->category_id);
        }
        if (isset($request->search)) {
            $data = $data->where('judul', 'like', '%' . $request->search . '%');
        }

        $data = $data->simplePaginate($request->get('per_page', 10));

        foreach ($data as $key => $value) {
            $data[$key]->konten = substr((strip_tags($data[$key]->konten)), 0, 120) . "...";
        }

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Artikel::where('slug', $id)->with('kategori')->first();
        if (!$data) {
            return response()->json([
                'error' => true,
                'message' => "Data tidak ditemukan"
            ]);
        }
        $data->konten = substr((strip_tags($data->konten)), 0, 55) . "...";
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
