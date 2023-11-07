<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\KategoriArtikel;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['page_title'] = "Kategori Berita";
        if ($request->type == 'datatable') {
            $dataContent = KategoriArtikel::orderBy('nama', 'ASC')
                ->get();

            return datatables()->of($dataContent)
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group"><button type="button" class="btn btn-rounded btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-gear"></i> Action <span class="caret"></span></button><ul class="dropdown-menu"><li><a href="' . route('kategori-berita.edit', $data->id) . '">Edit</a></li><li><a data-id="' . $data->id . '" data-label="kategori-berita" data-url="/kategori-berita/' . $data->id . '" class="delete-item text-danger">Delete</a></li></ul></div>';
                })
                ->addColumn('status', function ($data) {
                    return '';
                })

                ->rawColumns(['action'])
                ->make(true);
        } else if ($request->type == 'json') {
            $dataContent = KategoriArtikel::orderBy('nama', 'ASC');

            if ($request->keyword) {
                $dataContent = $dataContent->where(
                    'nama',
                    'LIKE',
                    DB::raw('"%' . $request->keyword . '%"')
                );
            }

            $dataContent = $dataContent::get();

            return response()->json($dataContent);
        } else {
            return view('web_front.kategori_artikel.index', $data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('web_front.kategori_artikel.create', [
            'page_title' => "Tambah Kategori"
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
        //

        $this->validate($request, [
            'nama' => 'required'
        ]);

        $req = [
            'nama' => $request->nama,
            'status' => (int)isset($request->status)
        ];

        KategoriArtikel::create($req);


        return redirect()->route('kategori-berita.index');
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
        $data = KategoriArtikel::find($id);
        return view('web_front.kategori_artikel.edit', [
            'page_title' => "Edit Kategori",
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
            'nama' => 'required'
        ]);

        $req = [
            'nama' => $request->nama,
            'status' => (int)isset($request->status)
        ];

        KategoriArtikel::find($id)->update($req);


        return redirect()->route('kategori-berita.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = KategoriArtikel::find($id);

        if ($data == null) {
            abort(404);
        }

        $data->delete();

        return response()->json([
            'error' => false,
            'message' => 'Kategori berhasil dihapus.'
        ]);
    }
}
