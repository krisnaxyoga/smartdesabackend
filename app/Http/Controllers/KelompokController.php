<?php

namespace App\Http\Controllers;

use App\Kelompok;
use App\KelompokAnggota;
use App\KelompokMaster;
use App\Penduduk;
use Illuminate\Http\Request;

class KelompokController extends Controller
{
    /**
     * Controller construction.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $data['listKelompokMaster'] = KelompokMaster::orderBy('id', 'ASC')->get();

        $master_id = 0;

        // if(count($data['listKelompokMaster']) > 0) {
        //     $master_id = $data['listKelompokMaster'][0]->id;
        // }

        if (isset($request->kelompok)) {
            $master_id = $request->kelompok;
        }

        if ($request->type == 'datatable') {
            $kelompokList = Kelompok::select('kelompok.*', 'penduduk.nama as nama_ketua', 'kelompok_master.kelompok as nama_kelompok')
                ->join('penduduk', 'penduduk.id', '=', 'kelompok.ketua_id')
                ->join('kelompok_master', 'kelompok_master.id', '=', 'kelompok.kelompok_master_id');
            if ($master_id != 0) {
                $kelompokList = $kelompokList->where('kelompok.kelompok_master_id', $master_id);
            }

            $kelompokList = $kelompokList->orderBy('id', 'ASC');

            return datatables()->of($kelompokList)
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group">
                                <button type="button" class="btn btn-rounded btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-gear"></i> Action <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a target="_blank" href="' . route('kelompok.edit', $data->id) . '">Edit</a></li>
                                    <li><a data-id="' . $data->id . '" data-label="kelompok" data-url="/kelompok/' . $data->id . '" class="delete-item text-danger">Delete</a></li>
                                </ul>
                            </div>';
                })
                ->editColumn('nama', function ($data) {
                    return "<a target='_blank' href='" . route('kelompok.show', $data->id) . "' class='link'>" . $data->nama . "</a>";
                })
                ->rawColumns(['action', 'valid', 'nama'])
                ->make(true);
        }

        $data['listKelompok'] = Kelompok::where('kelompok_master_id', $master_id)->get();

        $data['page_title'] = "Kelompok";
        $data['master_id'] = $master_id;
        return view('kelompok.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['listPenduduk'] = Penduduk::get();
        $data['listKelompok'] = KelompokMaster::get();

        $data['page_title'] = "Tambah Kelompok";
        return view('kelompok.create', $data);
    }

    public function pendudukTanpaKelompok($kelompokId)
    {
        $kelompok = KelompokAnggota::select('penduduk_id')->where('kelompok_id',$kelompokId)->pluck('penduduk_id');

        $penduduk = Penduduk::select('penduduk.*', 'kelompok_anggota.kelompok_id')
                    ->leftJoin('kelompok_anggota', 'penduduk.id', '=', 'kelompok_anggota.penduduk_id')
                    ->whereNotIn('penduduk.id', $kelompok)
                    ->where(function($e) {
                        $e->where('penduduk.nama','LIKE',"%".request('search')."%")
                          ->orWhere('penduduk.nik','LIKE',"%".request('search')."%");

                    })
                    ->get();

        return response()->json($penduduk);
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
            'nama' => 'required',
        ]);

        $req = $request->all();

        try {
            $klp = Kelompok::create($req);
            KelompokAnggota::create([
                'penduduk_id' => $req['ketua_id'],
                'kelompok_id' => $klp->id,
                'no_anggota' => '',
            ]);
            return redirect('kelompok?kelompok=' . $request->kelompok_master_id);
        } catch (\Exception $e) {
            dd($e->getMessage() . " : " . $e->getLine());
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
        $kelompok = Kelompok::where('id', $id)
            ->with([
                'anggota' => function ($anggota) {
                    $anggota->with('penduduk');
                },
                'kategori'
            ])->first();

        return view('kelompok.detail', [
            'data' => $kelompok,
            'page_title' => "Detail Kelompok " . $kelompok->nama
        ]);
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
        $data['data'] = Kelompok::find($id);
        $data['listPenduduk'] = Penduduk::get();
        $data['listKelompok'] = KelompokMaster::get();

        $data['page_title'] = "Edit Kelompok " . $data['data']->nama;
        return view('kelompok.edit', $data);
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
        $this->validate($request, [
            'nama' => 'required',
        ]);

        $req = $request->all();

        try {
            $req = [
                'nama' => $request->nama,
                'kode' => $request->kode,
                'ketua_id' => $request->ketua_id,
                'kelompok_master_id' => $request->kelompok_master_id,
                'keterangan' => $request->keterangan,
            ];
            $klp = Kelompok::find($id);
            $klp->update($req);

            $ketua = KelompokAnggota::where('kelompok_id', $klp->id)->where('penduduk_id', $request->ketua_id)->count();

            if ($ketua == 0) {
                KelompokAnggota::create([
                    'penduduk_id' => $req['ketua_id'],
                    'kelompok_id' => $klp->id,
                    'no_anggota' => '',
                ]);
            }


            return redirect('kelompok?kelompok=' . $request->kelompok_master_id);
        } catch (\Exception $e) {
            dd($e->getMessage() . " : " . $e->getLine());
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
        //

        try {
            KelompokAnggota::where('kelompok_id', $id)->delete();
            Kelompok::find($id)->delete();

            if ($request->ajax()) {
                return response()->json([
                    'error' => false,
                    'message' => 'Kelompok successfully deleted.'
                ]);
            }

            return redirect()->back()->with('success', 'Kelompok successfully deleted.');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'error' => false,
                    'message' => 'Kelompok failed to delete.'
                ]);
            }

            return redirect()->back()->with('error', 'Kelompok failed to delete.');
        }
    }

    public function createCategory()
    {

        return view('kelompok.category-create', [
            'page_title' => "Tambah Kategori Kelompok"
        ]);
    }

    public function storeCategory(Request $request)
    {
        $category = KelompokMaster::create($request->all());
        return redirect('kelompok?kelompok=' . $category->id);
    }

    public function tambahAnggota($kelompok_id)
    {
        $kelompok = Kelompok::find($kelompok_id);
        return view('kelompok.anggota.create', [
            'data' => $kelompok,
            'page_title' => "Tambah Anggota Kelompok " . $kelompok->nama
        ]);
    }

    public function simpanAnggota(Request $request, $id_kelompok)
    {
        $kelompok = Kelompok::find($id_kelompok);

        try {
            $kelompok->dataAnggota()->attach($request->penduduk_id, [
                'no_anggota' => $request->no_anggota
            ]);

            return redirect()->route('kelompok.show', [$id_kelompok]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function hapusAnggota($kelompok_id, $anggota)
    {
        $kelompok = Kelompok::find($kelompok_id);
        $kelompok->dataAnggota()->detach($anggota);

        return redirect()->route('kelompok.show', $kelompok_id);
    }

    public function editAnggota($kelompok_id, $anggota_id)
    {
        $anggota = KelompokAnggota::find($anggota_id);

        return view('kelompok.anggota.edit', [
            'data' => $anggota,
            'page_title' => "Edit Anggota"
        ]);
    }

    public function updateAnggota(Request $request, $anggota_id)
    {
        $anggota = KelompokAnggota::find($anggota_id);

        $anggota->update([
            'no_anggota' => $request->no_anggota
        ]);

        return redirect()->route('kelompok.show', [$anggota->kelompok_id]);
    }
}
