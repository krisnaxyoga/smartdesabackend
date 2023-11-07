<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KategoriInventaris;

class KategoriInventarisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = KategoriInventaris::orderBy('kelompok','DESC');
        // dd($data);
        if ($request->type == "datatable") {

            return datatables()->of($data)
            ->addColumn('action', function ($data) {
                return '<div class="btn-group">
                            <button type="button" class="btn btn-rounded btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-gear"></i> Action <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="' . route('kategori-aset.edit', $data->id) . '">Edit</a></li>
                                <li><a data-id="' . $data->id . '" data-label="Kategori Aset" data-url="/aset/kategori-aset/' . $data->id . '" class="delete-item text-danger">Delete</a></li>
                            </ul>
                        </div>';
            })
            ->rawColumns(['action'])
            ->make(true);

        }
        return view('inventaris.kategori.index',[
            'page_title' => 'Kategori Aset Desa'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventaris.kategori.create', [
            'page_title' => 'Buat Kategori Aset'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'nama_kategori' => 'required'
        ]);

        $data = ['nama_kategori' => $request->nama_kategori];

        try {
            KategoriInventaris::create($data);
            return redirect()->route('kategori-aset.index');
        } catch (\Throwable $e) {
            return back()
                ->with('error', "Error on file {$e->getFile()} line {$e->getLine()}: {$e->getMessage()}");
        }
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
        $data = KategoriInventaris::find($id);
        return view('inventaris.kategori.edit', [
            'page_title' => 'Update Kategori Aset',
            'data' => $data
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
        $this->validate($request, [
            'nama_kategori' => 'required'
        ]);

        $data = ['nama_kategori' => $request->nama_kategori];

        try {
            KategoriInventaris::find($id)->update($data);
            return redirect()->route('kategori-aset.index');
        } catch (\Throwable $e) {
            return back()
                ->with('error', "Error on file {$e->getFile()} line {$e->getLine()}: {$e->getMessage()}");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try {
            KategoriInventaris::where('id', $id)->delete();

            if ($request->ajax()) {
                return response()->json([
                    'error' => false,
                    'message' => 'Kategori Aset successfully deleted.'
                ]);
            }

            return redirect()->back()->with('success', 'Kategori Aset successfully deleted.');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'error' => false,
                    'message' => 'Kategori Aset failed to delete.'
                ]);
            }

            return redirect()->back()->with('error', 'Kategori Aset failed to delete.');
        }
    }

    public function getKategoriAsset(Request $request)
    {
        $data = KategoriInventaris::select('kategori_inventaris.*')->where('kategori_inventaris.nama_kategori', 'like', "%" . $request->search . "%")->limit(10)->get();
        return response()->json($data);
    }

}
