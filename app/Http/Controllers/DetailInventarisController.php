<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\DetailInventaris;
use App\LogInventaris;
use App\Inventaris;

class DetailInventarisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        // dd($id);
        $data = DetailInventaris::where('inventaris_id', $id);

        if ($request->type == "datatable") {
            return datatables()->of($data)
            ->addColumn('action', function ($data) {
                return '
                    <a class="btn btn-warning" href="' . route('detail-aset.edit', [$data->inventaris_id, $data->id]) . '"><i class="fa fa-pencil"></i></a>
                    <a data-id="' . $data->id . '" data-label="Stok Aset" data-url="'.$data->inventaris_id.'/detail-aset/'.$data->id.'" class="delete-item btn btn-danger text-white"><i class="fa fa-trash"></i></a>
                    <a class="btn btn-secondary" href="' . route('detail-aset.show', [$data->inventaris_id, $data->id]) . '"><i class="fa fa-file-text"></i></a>
                    <a class="btn btn-primary" href="' . route('barcode.detail', [$data->inventaris_id, $data->id]) . '" target="_blank"><i class="fa fa-print"></i></a>
                ';
            })
            ->editColumn('kondisi', function ($data){
                if ($data->kondisi == "B") {
                    return "Baik";
                }elseif($data->kondisi == "KB"){
                    return "Kurang Baik";
                }elseif($data->kondisi == "RB"){
                    return "Rusak Berat";
                }
            })
            ->editColumn('keterangan', function ($data){
                if ($data->keterangan == null) {
                    return "-";
                }else{
                    return $data->keterangan;
                }
            })
            ->rawColumns(['action'])
            ->make(true);

        }

        return response()->json($data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $data['page_title'] = 'Tambah Stok';
        $data['id'] = $id;
        $aset = Inventaris::where('id',$id)->with('kategori')->first();
        $count = DetailInventaris::where('inventaris_id',$id)->count();
        $data['kode_register'] = $aset->kategori->golongan.".".$aset->kategori->bidang.".".$aset->kategori->kelompok.".".$aset->kategori->sub_kelompok.".".$aset->kategori->sub_sub_kelompok.".".sprintf("%06s", $count+1);
        return view('inventaris.detail-inventaris.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'kode_register' => 'required',
            'kondisi' => 'required',
        ]);
        $data = [
            'inventaris_id' => $id,
            'kode_register' => $request->kode_register,
            'kondisi' => $request->kondisi,
            'keterangan' => $request->keterangan
        ];

        try {
            $a = DetailInventaris::create($data);

            $count = DetailInventaris::where('inventaris_id',$id)->count();
            $stock = ['stock' => $count];
            Inventaris::where('id',$id)->update($stock);
            $data_log = [
                'detail_inventaris_id' => $a->id,
                'kondisi_lama' => $request->kondisi,
                'kondisi_baru' => '-',
                'keterangan' => $request->keterangan
            ];
            LogInventaris::create($data_log);
            return redirect()->route('aset.show', $id);
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
    public function show($id, $idLog)
    {
        // $data['inventaris'] = Inventaris::select('inventaris.id', 'nama_inventaris', 'unit.nama_unit', 'sumber_inventaris.nama_sumber_inventaris', 'merk', 'no_sertifikat', 'bahan', 'tahun_perolehan', 'ukuran', 'keterangan')
        // ->join('unit', 'unit.id', '=', 'inventaris.unit_id')
        // ->join('sumber_inventaris', 'sumber_inventaris.id', '=', 'inventaris.sumber_inventaris_id')
        // ->find($id);

        $data['inventaris'] = Inventaris::select('inventaris.*','kategori_inventaris.nama_kategori','bidang_eplanning.nama_bidang','sumber_inventaris.nama_sumber_inventaris','unit.nama_unit')
        ->leftJoin('kategori_inventaris','kategori_inventaris.id','=','inventaris.kategori_id')
        ->leftJoin('bidang_eplanning','bidang_eplanning.id','=','inventaris.bidang_id')
        ->leftJoin('sumber_inventaris','sumber_inventaris.id','=','inventaris.sumber_inventaris_id')
        ->leftJoin('unit','unit.id','=','inventaris.unit_id')
        ->find($id);

        $data['log'] = DetailInventaris::find($idLog);

        return view('inventaris.detail-inventaris.detail', [
            'page_title' => 'Log Aset',
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $id_stok)
    {
        $data = DetailInventaris::find($id_stok);

        return view('inventaris.detail-inventaris.edit', [
            'page_title' => 'Edit Stok Aset',
            'id' => $id,
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
    public function update(Request $request, $id, $id_stok)
    {
        $this->validate($request, [
            'kode_register' => 'required',
            'kondisi' => 'required',
            'keterangan' => 'required',
        ]);

        $data = [
            'inventaris_id' => $id,
            'kode_register' => $request->kode_register,
            'kondisi' => $request->kondisi,
            'keterangan' => $request->keterangan
        ];

        try {
            $a = DetailInventaris::find($id_stok);

            $data_log = [
                'detail_inventaris_id' => $id_stok,
                'kondisi_lama' => $a->kondisi,
                'kondisi_baru' => $request->kondisi,
                'keterangan' => $request->keterangan
            ];

            DetailInventaris::find($id_stok)->update($data);
            LogInventaris::create($data_log);

            return redirect()->route('aset.show', $id);
        } catch (\Throwable $e) {
            return back()
                ->with('error', "Error on file {$e->getFile()} line {$e->getLine()}: {$e->getMessage()}");
        }

        // dd($request, $id, $id_stok);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id, $id_stok)
    {
        try {
            DetailInventaris::find($id_stok)->delete();

            $count = DetailInventaris::where('inventaris_id',$id)->count();
            $stock = ['stock' => $count];
            Inventaris::where('id',$id)->update($stock);

            if ($request->ajax()) {
                return response()->json([
                    'error' => false,
                    'message' => 'Stok Aset successfully deleted.'
                ]);
            }

            return redirect()->back()->with('success', 'Stok Aset successfully deleted.');

        } catch (\Throwable $e) {
            if ($request->ajax()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Stok Aset failed to delete.'
                ]);
            }

            return redirect()->back()->with('error', 'Stok Aset failed to delete.');
        }
    }
}


