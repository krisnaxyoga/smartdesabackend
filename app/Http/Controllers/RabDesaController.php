<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\RabDesa;
use App\UsulanDesa;
use App\UraianRab;
use App\KategoriBarang;
use App\Barang;
use DB;

class RabDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = RabDesa::select('rab.id', 'rab.no_rab', 'kegiatan_eplanning.nama_kegiatan')
                ->join('kegiatan_eplanning', 'kegiatan_eplanning.id', '=', 'rab.id_kegiatan')
                ->get();

        if ($request->type == "datatable") {

            return datatables()->of($data)
            ->addColumn('action', function ($data) {
                return '<div class="btn-group">
                            <button type="button" class="btn btn-rounded btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-gear"></i> Action <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="' . route('rab-desa.edit', $data->id) . '">Edit</a></li>
                                <li><a data-id="' . $data->id . '" data-label="RAB Desa" data-url="/e-planning/rab-desa/' . $data->id . '" class="delete-item text-danger">Delete</a></li>
                            </ul>
                        </div>';
            })
            ->editColumn('no_rab', function ($data){
                return '<a href="'.route('rab-desa.show', $data->id).'" class="text-primary">'.$data->no_rab.'</a>';
            })
            ->addColumn('print', function($data){
                return '<a href="'.route('report.rab', $data->id).'" class="btn btn-rounded btn-primary text-white" target="_blank">
                            <i class="fa fa-print"></i> Print RAB <span class="caret"></span>
                        </a>';
            })
            ->rawColumns(['action', 'no_rab', 'print'])
            ->make(true);

        }
        return view('e-planning.rab.index',[
            'page_title' => 'RAB Desa'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rkp = UsulanDesa::select('kegiatan_eplanning.id as id', 'kegiatan_eplanning.nama_kegiatan', 'bidang_eplanning.nama_bidang')
                ->join('bidang_eplanning', 'bidang_eplanning.id', '=', 'kegiatan_eplanning.sub_bidang_id')
                ->where('kegiatan_eplanning.rkp_id', '!=', NULL)
                ->get();
                // dd($rkp);

        $uraian = KategoriBarang::whereHas('barang')->with('barang')->orderBy('name','ASC')->get();
        return view('e-planning.rab.create',[
            'page_title' => "Buat RAB",
            'data' => $rkp,
            'uraian' => $uraian
        ]);
    }

    public function getItemPrice($id)
    {
        $data = Barang::find($id);
        return response()->json($data);
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
        // return response()->json($request);

        $this->validate($request, [
            'no_rab' => 'required',
            'id_kegiatan' => 'required',
            'barang_id' => 'required',
            // 'kategori_uraian' => 'required',
            // 'uraian' => 'required',
            'volume' => 'required',
            'satuan' => 'required',
            'harga_satuan' => 'required',
            'jumlah_total' => 'required',
            'keterangan' => 'required',
        ]);

        $r = $request->only('no_rab', 'id_kegiatan');

        // $dataKategori = $request->kategori_uraian;
        // $dataUraian = $request->uraian;
        $dataBarangId = $request->barang_id;
        $dataVolume = $request->volume;
        $dataSatuan = $request->satuan;
        $dataHarga = $request->harga_satuan;
        $dataJumlah = $request->jumlah_total;
        $dataKet = $request->keterangan;

        DB::beginTransaction();

        try {
            $rab = RabDesa::create($r);
            foreach ($dataBarangId as $key => $value) {
                $data = [
                    'id_rab' => $rab->id,
                    // 'kategori_uraian' => $dataKategori[$key],
                    // 'nama_uraian' => $dataUraian[$key],
                    'barang_id'=> $dataBarangId[$key],
                    'volume' => $dataVolume[$key],
                    'satuan' => $dataSatuan[$key],
                    'harga_satuan' => $dataHarga[$key],
                    'jumlah_total' => $dataJumlah[$key],
                    'keterangan' => $dataKet[$key]
                ];
                // dd($data);
                UraianRab::create($data);
            }
            DB::commit();
            return redirect()->route('rab-desa.index');
        } catch (\Throwable $e) {
            DB::rollback();
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
    public function show(Request $request, $id)
    {
        $data = RabDesa::select('rab.id as id', 'rab.no_rab', 'bidang_eplanning.nama_bidang', 'kegiatan_eplanning.nama_kegiatan')
            ->where('rab.id', $id)
            ->join('kegiatan_eplanning', 'kegiatan_eplanning.id', '=', 'rab.id_kegiatan')
            ->join('bidang_eplanning', 'bidang_eplanning.id', '=', 'kegiatan_eplanning.sub_bidang_id')
            ->first();
        if ($request->type == "datatable") {
            $dataUraian = UraianRab::where('id_rab', $id)->select('uraian_rab.id','uraian_rab.barang_id','uraian_rab.volume','uraian_rab.satuan','uraian_rab.harga_satuan','uraian_rab.jumlah_total','uraian_rab.keterangan','barang.name as nama_uraian','kategori_barang.name as kategori_uraian')->join('barang','barang.id','=','uraian_rab.barang_id')->join('kategori_barang','kategori_barang.id','=','barang.kategori_barang_id')->get();
            return datatables()->of($dataUraian)
            ->addColumn('action', function ($dataUraian) {
                return '<div class="btn-group">
                            <button type="button" class="btn btn-rounded btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-gear"></i> Action <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="' . route('rab-desa.edit', $dataUraian->id) . '">Edit</a></li>
                                <li><a data-id="' . $dataUraian->id . '" data-label="RAB" data-url="/e-planning/rab-desa/' . $dataUraian->id . '" class="delete-item text-danger">Delete</a></li>
                            </ul>
                        </div>';
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('e-planning.rab.detail', [
            'page_title' => 'Detail RAB',
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $data['rab'] = RabDesa::find($id);
        $data['rkp'] = UsulanDesa::select('kegiatan_eplanning.id as id', 'kegiatan_eplanning.nama_kegiatan', 'bidang_eplanning.nama_bidang')
                        ->join('bidang_eplanning', 'bidang_eplanning.id', '=', 'kegiatan_eplanning.sub_bidang_id')
                        ->where('kegiatan_eplanning.rkp_id', '!=', NULL)
                        ->get();
        $data['uraian'] = KategoriBarang::whereHas('barang')->with('barang')->orderBy('name','ASC')->get();
        if ($request->type == 'edit') {
            $data = UraianRab::where('id_rab', $id)->orderBy('id_rab', 'ASC')->get();
            return response()->json($data);
        }

        return view('e-planning.rab.edit',[
            'page_title' => 'Edit RAB Desa',
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
        // dd($request);

        $this->validate($request, [
            'no_rab' => 'required',
            'id_kegiatan' => 'required',
            'barang_id' => 'required',
            // 'kategori_uraian' => 'required',
            // 'uraian' => 'required',
            'volume' => 'required',
            'satuan' => 'required',
            'harga_satuan' => 'required',
            'jumlah_total' => 'required',
            'keterangan' => 'required',
        ]);

        $r = $request->only('no_rab', 'id_kegiatan');

        // $dataKategori = $request->kategori_uraian;
        // $dataUraian = $request->uraian;
        $dataBarangId = $request->barang_id;
        $dataVolume = $request->volume;
        $dataSatuan = $request->satuan;
        $dataHarga = $request->harga_satuan;
        $dataJumlah = $request->jumlah_total;
        $dataKet = $request->keterangan;
        DB::beginTransaction();
        try {
            RabDesa::find($id)->update($r);
            UraianRab::where('id_rab', $id)->delete();
            foreach ($dataBarangId as $key => $value) {
                $data = [
                    'id_rab' => $id,
                    'barang_id' => $dataBarangId[$key],
                    // 'nama_uraian' => $dataUraian[$key],
                    'volume' => $dataVolume[$key],
                    'satuan' => $dataSatuan[$key],
                    'harga_satuan' => $dataHarga[$key],
                    'jumlah_total' => $dataJumlah[$key],
                    'keterangan' => $dataKet[$key]
                ];
                // dd($data);
                UraianRab::create($data);
            }
            DB::commit();
            // dd('SUCCESS');
            return redirect()->route('rab-desa.index');
        } catch (\Throwable $e) {
            // dd("ERROR", $e);
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
            UraianRab::where('id_rab', $id)->delete();
            RabDesa::where('id', $id)->delete();

            if ($request->ajax()) {
                return response()->json([
                    'error' => false,
                    'message' => 'Usulan Desa successfully deleted.'
                ]);
            }

            return redirect()->back()->with('success', 'Usulan Desa successfully deleted.');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'error' => false,
                    'message' => 'Usulan Desa failed to delete.'
                ]);
            }

            return redirect()->back()->with('error', 'Usulan Desa failed to delete.');
        }
    }

    public function deleteUraian($id)
    {
        try {
            UraianRab::where('id', $id)->delete();
            return "Success";
        } catch (\Throwable $th) {
            return ["Error", $th];
        }
    }

    public function reportRab($id)
    {
        $data['rab'] = RabDesa::select('rab.no_rab', 'desa.nama_desa','desa.nama_kecamatan','desa.nama_kabupaten','desa.nama_propinsi', 'rab.created_at', 'kegiatan_eplanning.nama_kegiatan', 'bidang_eplanning.nama_bidang')
            ->join('desa', 'desa.id', '=', 'rab.desa_id')
            ->join('kegiatan_eplanning', 'kegiatan_eplanning.id', '=', 'rab.id_kegiatan')
            ->join('bidang_eplanning', 'bidang_eplanning.id', '=', 'kegiatan_eplanning.sub_bidang_id')
            ->find($id);

        // $data['uraian'] = UraianRab::where('id_rab', $id)->select('uraian_rab.id','uraian_rab.barang_id','uraian_rab.volume','uraian_rab.satuan','uraian_rab.harga_satuan','uraian_rab.jumlah_total','uraian_rab.keterangan','barang.name as nama_uraian','kategori_barang.name as kategori_uraian')->join('barang','barang.id','=','uraian_rab.barang_id')->join('kategori_barang','kategori_barang.id','=','barang.kategori_barang_id')->get();
        $data['kategori'] = KategoriBarang::whereHas('barang', function($barang) use ($id) {
                                                $barang->whereHas('uraian', function($query) use ($id) {
                                                    $query->where('id_rab', '=', $id);
                                                });
                                            })->with(['barang' => function($barang) use ($id) {
                                                $barang->with(['uraian' => function($query) use ($id) {
                                                    $query->where('id_rab', '=', $id);
                                                }]);
                                            }])->get();
       // return response()->json($data);
        return view('e-planning.export-pdf.rab-report-2', [
            'data' => $data
        ]);
    }
}
