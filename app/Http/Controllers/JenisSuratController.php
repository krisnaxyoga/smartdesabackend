<?php

namespace App\Http\Controllers;

use App\JenisSurat;
use Illuminate\Http\Request;

class JenisSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (isset($request->type)) {
            if ($request->type == 'datatable') {
                $data = JenisSurat::orderBy('jenis_surat.created_at', 'DESC')->get();

                return datatables()->of($data)
                    ->addColumn('action', function ($data) {
                        $detail = "<center><a href='" . route('jenis-surat.edit', [$data->id]) . "' class='btn btn-warning btn-sm text-center' style='display : inline-block'><i class='fa fa-pencil'></i></a></center>";
                        // return '<div class="btn-group"><button type="button" class="btn btn-rounded btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-gear"></i> Action <span class="caret"></span></button><ul class="dropdown-menu"><li><a href="' . route('suku.edit', $data->id) . '">Edit</a></li><li><a data-id="' . $data->id . '" data-label="suku" data-url="/suku/' . $data->id . '" class="delete-item text-danger">Delete</a></li></ul></div>';
                        return $detail;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
        }
        return view('surat.jenis_surat.index', [
            'page_title' => "Jenis Surat "
        ]);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = JenisSurat::findOrFail($id);
        return view('surat.jenis_surat.edit', [
            'data' => $data,
            'page_title' => "Edit Jenis Surat : {$data->kode_surat}"
        ]);
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
        $data = JenisSurat::findOrFail($id);
        $update = [
            'judul' => $request->judul,
            'is_mobile' => isset($request->is_mobile),
        ];
        $data->update($update);
        return redirect()->route('jenis-surat.index');
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
