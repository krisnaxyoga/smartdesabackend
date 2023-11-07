<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KelompokMaster;

class KategoriKelompokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = KelompokMaster::orderBy('id', 'DESC');
        // dd($data);

        if ($request->type == "datatable") {

            return datatables()->of($data)
            ->addColumn('action', function ($data) {
                return '<div class="btn-group">
                            <button type="button" class="btn btn-rounded btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-gear"></i> Action <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a target="_blank" href="' . route('kategori-kelompok.edit', $data->id) . '">Edit</a></li>
                                <li><a data-id="' . $data->id . '" data-label="kategori-kelompok" data-url="/kategori-kelompok/' . $data->id . '" class="delete-item text-danger">Delete</a></li>
                            </ul>
                        </div>';
            })
            ->rawColumns(['action'])
            ->make(true);

        }
        return view('kategori_kelompok.index',[
            'page_title' => 'Tambah Kategori Kelompok'
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
        return view('kategori_kelompok.create',[
            'page_title' => 'Tambah Kategori Kelompok'
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

        try {
            $tes = KelompokMaster::create([
                'kelompok' => $request->kelompok,
                'deskripsi' => $request->deskripsi,               
            ]);
            return redirect()->route('kategori-kelompok.index');
        } catch (\Throwable $e) {
            return back()->with('error', "Error on file {$e->getFile()} line {$e->getLine()}: {$e->getMessage()}");
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
    public function edit(Request $request, $id)
    {
        $data = KelompokMaster::find($id);
        return view('kategori_kelompok.edit', [
            'data' => $data,
            'page_title' => "Edit Kategori Kelompok : {$data->kelompok}"
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

        // dd($request);

        $update = [
            'kelompok' => $request->kelompok,
            'deskripsi' => $request->deskripsi,
        ];
        KelompokMaster::find($id)->update($update);

        return redirect('kategori-kelompok')->with('success', 'Kategori Kelompok successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //

        try {
            KelompokMaster::find($id)->delete();

            if ($request->ajax()) {
                return response()->json([
                    'error' => false,
                    'message' => 'Kategori Kelompok successfully deleted.'
                ]);
            }

            return redirect()->back()->with('success', 'Kategori Kelompok successfully deleted.');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'error' => false,
                    'message' => 'Kategori Kelompok failed to delete.'
                ]);
            }

            return redirect()->back()->with('error', 'Kategori Kelompok failed to delete.');
        }
    }
}
