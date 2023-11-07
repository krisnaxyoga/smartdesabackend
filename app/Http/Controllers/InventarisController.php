<?php

namespace App\Http\Controllers;

use App\BidangEplanning;
use App\Desa;
use Illuminate\Http\Request;

use App\Inventaris;
use App\KategoriInventaris;
use App\DetailInventaris;
use App\UnitInventaris;
use App\SumberInventaris;
use App\LogInventaris;
use DB;

class InventarisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Inventaris::select('inventaris.*','kategori_inventaris.nama_kategori')->leftJoin('kategori_inventaris','kategori_inventaris.id','=','inventaris.kategori_id')->orderBy('created_at','DESC')->get();


        if ($request->type == "datatable") {

            return datatables()->of($data)
            ->addColumn('action', function ($data) {
                return '<div class="btn-group">
                            <button type="button" class="btn btn-rounded btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-gear"></i> Action <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="' . route('aset.edit', $data->id) . '">Edit</a></li>
                                <li><a data-id="' . $data->id . '" data-label="Aset" data-url="/aset/' . $data->id . '" class="delete-item text-danger">Delete</a></li>
                            </ul>
                        </div>';
            })
            ->editColumn('kode_barang', function ($data){
                return '<a class="text-primary" href="' . route('aset.show', $data->id) . '">'.$data->kode_barang.'</a>';
            })
            ->rawColumns(['action', 'kode_barang'])
            ->make(true);

        }

        return view('inventaris.index', [
            'page_title' => 'Daftar Aset'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['unit'] = UnitInventaris::all();
        $data['sumber'] = SumberInventaris::all();
        $data['bidang'] = BidangEplanning::all();
        $desa = auth()->user()->desa;
        $data['desa'] = $desa->kode_village.".".$desa->kode_kecamatan.".".$desa->kode_kabupaten.".".$desa->kode_propinsi;
        return view('inventaris.create', [
            'page_title' => 'Tambah Aset',
            'data' => $data
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
        DB::rollback();
        DB::beginTransaction();

        $this->validate($request, [
            'kategori_aset' => 'required',
            'nama_inventaris' => 'required',
            'tahun_perolehan' => 'required',
            'bidang' => 'required',
            'harga_perolehan' => 'required',
            'sumber_dana' => 'required',
            'stock' => 'required',
            'unit_inventaris' => 'required',
        ]);

        // if ($request->kode_barang == null) {
        //     $desa = Desa::where('id',auth()->user()->desa_id)->first();
        //     $bidang = BidangEplanning::where('kode_bidang',$request->bidang)->first();
        //     $kode_barang = $desa->kode_propinsi.".".$desa->kode_kabupaten.".".$desa->kode_kecamatan.".".$desa->kode_village.".".$bidang->kode_bidang.".".date('Y');
        // } else {
        //     $kode_barang = $request->kode_barang;
        //     $bidang = BidangEplanning::where('kode_bidang',$request->bidang)->first();
        // }
        $desa = auth()->user()->desa;
        $bidang = BidangEplanning::where('kode_bidang',$request->bidang)->first();
        $kode_barang = $desa->kode_propinsi.".".$desa->kode_kabupaten.".".$desa->kode_kecamatan.".".$desa->kode_village.".".$bidang->kode_bidang.".".date('Y');

        $data = [
            'kategori_id' => $request->kategori_aset,
            'kode_barang' => $kode_barang,
            'bidang_id' => $bidang->id,
            'tahun_perolehan' => $request->tahun_perolehan,
            'stock' => $request->stock,
            'harga_perolehan' => $request->harga_perolehan,
            'sumber_inventaris_id' => $request->sumber_dana,
            'nama_inventaris' => $request->nama_inventaris,
            'merk' => $request->merk,
            'no_sertifikat' => $request->no_sertifikat,
            'bahan' => $request->bahan,
            'unit_id' => $request->unit_inventaris,
            'keterangan' => $request->keterangan
        ];
        try {
            $data = Inventaris::create($data);

            for ($i=0; $i < $request->stock; $i++) {
                $stock = new DetailInventaris();

                $stock->inventaris_id = $data->id;
                $stock->kode_register = $request->no_regist.".".sprintf("%06s", $i+1);
                $stock->kondisi = $request->kondisi;
                $stock->save();

                $data_log = [
                    'detail_inventaris_id' => $stock->id,
                    'kondisi_lama' => $request->kondisi,
                    'kondisi_baru' => "-",
                    'keterangan' => $request->keterangan
                ];
                LogInventaris::create($data_log);
            }


            DB::commit();
            return redirect()->route('aset.index');
        } catch (\Throwable $e) {
            DB::rollback();
            dd($e);
            return back()
                ->with('error', "Error on file {$e->getFile()} line {$e->getLine()}: {$e->getMessage()}");
        } catch (\Throwable $e) {
            DB::rollback();
            dd($e);
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
        $data = Inventaris::select('inventaris.*','kategori_inventaris.nama_kategori','bidang_eplanning.nama_bidang','sumber_inventaris.nama_sumber_inventaris','unit.nama_unit')
                            ->leftJoin('kategori_inventaris','kategori_inventaris.id','=','inventaris.kategori_id')
                            ->leftJoin('bidang_eplanning','bidang_eplanning.id','=','inventaris.bidang_id')
                            ->leftJoin('sumber_inventaris','sumber_inventaris.id','=','inventaris.sumber_inventaris_id')
                            ->leftJoin('unit','unit.id','=','inventaris.unit_id')
                            ->find($id);
        return view('inventaris.detail', [
            'page_title' => "Detail Aset",
            'data' => $data
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
        $data['page_title'] = "Edit Aset";
        $data['unit'] = UnitInventaris::all();
        $data['sumber'] = SumberInventaris::all();
        $data['inventaris'] = Inventaris::with('kategori')->find($id);
        $data['bidang'] = BidangEplanning::all();
        $desa = auth()->user()->desa;
        $data['desa'] = $desa->kode_village.".".$desa->kode_kecamatan.".".$desa->kode_kabupaten.".".$desa->kode_propinsi;
        // return response()->json($data);
        return view('inventaris.edit', $data);
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
        //dd($request);
        $this->validate($request, [
            'kategori_aset' => 'required',
            'nama_inventaris' => 'required',
            'tahun_perolehan' => 'required',
            'bidang' => 'required',
            'harga_perolehan' => 'required',
            'sumber_dana' => 'required',
            'unit_inventaris' => 'required',
            'kondisi' => 'required'
        ]);
        $bidang = BidangEplanning::where('kode_bidang',$request->bidang)->first();

        $data = [
            'kode_barang' => $request->kode_barang,
            'bidang_id' => $bidang->id,
            'tahun_perolehan' => $request->tahun_perolehan,
            'harga_perolehan' => $request->harga_perolehan,
            'sumber_inventaris_id' => $request->sumber_dana,
            'nama_inventaris' => $request->nama_inventaris,
            'merk' => $request->merk,
            'no_sertifikat' => $request->no_sertifikat,
            'bahan' => $request->bahan,
            'unit_id' => $request->unit_inventaris,
            'keterangan' => $request->keterangan
        ];
        try {
            // dd($data);
            $data = Inventaris::find($id)->update($data);

            $aset = Inventaris::where('id',$id)->with('kategori')->first();
            $kode_register = $aset->kategori->golongan.".".$aset->kategori->bidang.".".$aset->kategori->kelompok.".".$aset->kategori->sub_kelompok.".".$aset->kategori->sub_sub_kelompok;

            if ($kode_register != $request->no_regist) {

                $detail = DetailInventaris::where('inventaris_id',$id)->delete();

                for ($i=0; $i < $aset->stock; $i++) {

                    $stock = new DetailInventaris();
                    $stock->inventaris_id = $aset->id;
                    $stock->kode_register = $request->no_regist.".".sprintf("%06s", $i+1);
                    $stock->kondisi = $request->kondisi;
                    $stock->save();

                    $data_log = [
                        'detail_inventaris_id' => $stock->id,
                        'kondisi_lama' => $request->kondisi,
                        'kondisi_baru' => "-",
                        'keterangan' => $request->keterangan
                    ];
                    LogInventaris::create($data_log);
                }

                $data = Inventaris::find($id)->update([
                    'kategori_id' => $request->kategori_aset
                ]);
            }

            return redirect()->route('aset.index');
        } catch (\Throwable $e) {
            dd($e->getMessage());
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
            Inventaris::where('id', $id)->delete();

            if ($request->ajax()) {
                return response()->json([
                    'error' => false,
                    'message' => 'Aset successfully deleted.'
                ]);
            }

            return redirect()->back()->with('success', 'Aset successfully deleted.');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'error' => false,
                    'message' => 'Aset failed to delete.'
                ]);
            }

            return redirect()->back()->with('error', 'Aset failed to delete.');
        }
    }
}
