<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\RkpDesa;
use App\BidangEplanning;
use App\Wilayah;
use App\UsulanDesa;
use DB;
use App\RkpSumberDana;
use Illuminate\Support\Facades\Storage;
class RkpDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->type == 'datatable') {
            $data = RkpDesa::orderBy('tahun', 'DESC')->get();

            return datatables()->of($data)
            ->addColumn('action', function ($data) {
                return '<div class="btn-group">
                            <button type="button" class="btn btn-rounded btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-gear"></i> Action <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="' . route('rkp-desa.edit', $data->id) . '">Edit</a></li>
                                <li><a data-id="' . $data->id . '" data-label="RKP Desa" data-url="/e-planning/rkp-desa/' . $data->id . '" class="delete-item text-danger">Delete</a></li>
                            </ul>
                        </div>';
            })
            ->editColumn('tahun', function ($data){
                return '<a href="'.route('rkp-desa.show', $data->id).'" class="text-primary">'.$data->tahun.'</a>';
            })
            ->addColumn('print', function($data){
                return '<a href="'.route('report.rkp', $data->id).'" class="btn btn-rounded btn-primary text-white" target="_blank">
                            <i class="fa fa-print"></i> Print RKP <span class="caret"></span>
                        </a>';
            })
            ->rawColumns(['action', 'tahun', 'print'])
            ->make(true);
        }
        return view('e-planning.rkp.index',[
            'page_title' => 'RKP Desa'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['bidang'] = BidangEplanning::where('parent_id','!=', NULL)->orderBy('nama_bidang', 'ASC')->get();
        $data['sumber_dana'] = RkpSumberDana::orderBy('nama','ASC')->get();
        $data['lokasi'] = Wilayah::orderBy('dusun', 'ASC')->get();
        return view('e-planning.rkp.create',[
            'page_title' => 'Buat RKP',
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

        // return response()->json($request);
        $this->validate($request, [
            'tahun' => 'required|max: 4',
            'bidang_id' => 'required',
            'nama_kegiatan' => 'required',
            'wilayah_id' => 'required',
            'volume' => 'required',
            'manfaat' => 'required',
            'start_date' => 'required',
            'jumlah' => 'required|max: 13',
            'sumber_biaya' => 'required',
            'swakelola' => 'required',
            'kerjasama_antardesa' => 'required',
            'kerjasama_pihak_ketiga' => 'required',
            'rencana_pelaksana_kegiatan' => 'required',
        ]);

        $r = $request->only('tahun');

        $dataBidang = $request->bidang_id;
        $dataWilayah = $request->wilayah_id;
        $dataNamaKegiatan = $request->nama_kegiatan;
        $dataVolume = $request->volume;
        $dataManfaat = $request->manfaat;
        $dataWaktu = $request->start_date;
        $dataStatus = $request->status;
        $dataSwakelola = $request->swakelola;
        $dataKerjasamaAntardesa = $request->kerjasama_antardesa;
        $dataKerjasamaPihakKetiga = $request->kerjasama_pihak_ketiga;
        $dataSumberBiaya = $request->sumber_biaya;
        $dataJumlah = $request->jumlah;
        $dataRencanaPelaksanaanKegiatan = $request->rencana_pelaksana_kegiatan;
        $dataAttachment = $request->attachment;
        $dataId = $request->id_kegiatan;

        try {
            $rkp = RkpDesa::create($r);
            foreach ($dataBidang as $key => $value) {
                $data = [
                    'rkp_id' => $rkp->id,
                    'sub_bidang_id' => $dataBidang[$key],
                    'wilayah_id' => $dataWilayah[$key],
                    'nama_kegiatan' => $dataNamaKegiatan[$key],
                    'volume' => $dataVolume[$key],
                    'manfaat' =>$dataManfaat[$key],
                    'estimated_time' =>$dataWaktu[$key],
                    'attachment' => $dataAttachment[$key],
                    'swakelola' => $dataSwakelola[$key],
                    'kerjasama_antardesa' => $dataKerjasamaAntardesa[$key],
                    'kerjasama_pihak_ketiga' => $dataKerjasamaPihakKetiga[$key],
                    'sumber_biaya' => $dataSumberBiaya[$key],
                    'jumlah' => $dataJumlah[$key],
                    'rencana_pelaksana_kegiatan' => $dataRencanaPelaksanaanKegiatan[$key],
                    'status' => 'RKP'
                ];
                if ($dataId[$key] != NULL && $dataStatus[$key] == "USULAN DESA") {
                    // dd("del");
                    UsulanDesa::find($dataId[$key])->delete();
                }
                UsulanDesa::create($data);
            }
            return redirect()->route('rkp-desa.index');
        } catch (\Throwable $e) {
            dd("ERROR", $e);
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
    public function show(Request $request ,$id)
    {
        if ($request->type == 'datatable') {

            $data = UsulanDesa::select('bidang_eplanning.nama_bidang','rkp_sumber_dana.nama as sumber_biaya' ,'wilayah.dusun', 'kegiatan_eplanning.volume', 'kegiatan_eplanning.manfaat', 'kegiatan_eplanning.nama_kegiatan', 'kegiatan_eplanning.estimated_time', 'kegiatan_eplanning.jumlah', 'kegiatan_eplanning.swakelola', 'kegiatan_eplanning.kerjasama_antardesa', 'kegiatan_eplanning.kerjasama_pihak_ketiga', 'kegiatan_eplanning.rencana_pelaksana_kegiatan')
            ->join('bidang_eplanning','bidang_eplanning.id','=','kegiatan_eplanning.sub_bidang_id')
            ->join('wilayah', 'wilayah.id', '=', 'kegiatan_eplanning.wilayah_id')
            ->join('rkp_sumber_dana', 'rkp_sumber_dana.id', '=', 'kegiatan_eplanning.sumber_biaya')
            ->where('status', 'RKP')
            ->where('rkp_id', $id)
            ->orderBy('kegiatan_eplanning.nama_kegiatan', 'ASC')
            ->get();

            return datatables()->of($data)
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group">
                                <button type="button" class="btn btn-rounded btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-gear"></i> Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#!">Edit</a></li>
                                    <li><a data-id="' . $data->id . '" data-label="RKP Desa" data-url="/e-planning/usulan-desa/' . $data->id . '" class="delete-item text-danger">Delete</a></li>
                                </ul>
                            </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $data = RkpDesa::select('rkp_desa.id', 'rkp_desa.tahun')
            ->where('rkp_desa.id', $id)
            ->join('desa', 'desa.id', '=', 'rkp_desa.desa_id')
            ->first();

        return view('e-planning.rkp.detail',[
            'page_title' => 'Detail RKP',
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $data['rkp'] = RkpDesa::find($id);
        $data['bidang'] = BidangEplanning::where('parent_id','!=', NULL)->orderBy('nama_bidang', 'ASC')->get();
        $data['sumber_dana'] = RkpSumberDana::orderBy('nama','ASC')->get();
        $data['lokasi'] = Wilayah::orderBy('dusun', 'ASC')->get();

        if ($request->type == 'edit') {
            $data = UsulanDesa::where('rkp_id', $id)->orderBy('sub_bidang_id', 'ASC')->get();
            return response()->json($data);
            // return $kegiatan;
        }

        return view('e-planning.rkp.edit',[
            'page_title' => 'Edit RKP Desa',
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
        //return response()->json($request);
        $this->validate($request, [
            'tahun' => 'required|max: 4',
            'bidang_id' => 'required',
            'nama_kegiatan' => 'required',
            'wilayah_id' => 'required',
            'volume' => 'required',
            'manfaat' => 'required',
            'start_date' => 'required',
            'jumlah' => 'required|max: 13',
            'sumber_biaya' => 'required',
            'swakelola' => 'required',
            'kerjasama_antardesa' => 'required',
            'kerjasama_pihak_ketiga' => 'required',
            'rencana_pelaksana_kegiatan' => 'required',
        ]);

        $r = $request->only('tahun');

        $dataBidang = $request->bidang_id;
        $dataWilayah = $request->wilayah_id;
        $dataNamaKegiatan = $request->nama_kegiatan;
        $dataVolume = $request->volume;
        $dataManfaat = $request->manfaat;
        $dataWaktu = $request->start_date;
        $dataStatus = $request->status;
        $dataSwakelola = $request->swakelola;
        $dataKerjasamaAntardesa = $request->kerjasama_antardesa;
        $dataKerjasamaPihakKetiga = $request->kerjasama_pihak_ketiga;
        $dataSumberBiaya = $request->sumber_biaya;
        $dataJumlah = $request->jumlah;
        $dataRencanaPelaksanaanKegiatan = $request->rencana_pelaksana_kegiatan;
        $dataAttachment = $request->attachment;
        $dataId = $request->id_kegiatan;
        DB::beginTransaction();
        try {
            $rkp = RkpDesa::find($id)->update($r);

            UsulanDesa::where('rkp_id',$id)->delete();

            foreach ($dataBidang as $key => $value) {
                $data = [
                    'rkp_id' => $id,
                    'sub_bidang_id' => $dataBidang[$key],
                    'wilayah_id' => $dataWilayah[$key],
                    'nama_kegiatan' => $dataNamaKegiatan[$key],
                    'volume' => $dataVolume[$key],
                    'manfaat' =>$dataManfaat[$key],
                    'estimated_time' =>$dataWaktu[$key],
                    'swakelola' => $dataSwakelola[$key],
                    'kerjasama_antardesa' => $dataKerjasamaAntardesa[$key],
                    'kerjasama_pihak_ketiga' => $dataKerjasamaPihakKetiga[$key],
                    'sumber_biaya' => $dataSumberBiaya[$key],
                    'jumlah' => $dataJumlah[$key],
                    'swakelola' => $dataSwakelola[$key],
                    'rencana_pelaksana_kegiatan' => $dataRencanaPelaksanaanKegiatan[$key],
                    'attachment' => $dataAttachment[$key],
                    'status' => 'RKP'
                ];
                // $a = UsulanDesa::find($dataId[$key])->delete();
                // if ($a == true) {
                    UsulanDesa::create($data);
                // }
            }
            // dd($data);
            DB::commit();
            return redirect()->route('rkp-desa.index');
        } catch (\Throwable $e) {
            DB::rollback();
            dd("ERROR", $e);
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
            UsulanDesa::where('rkp_id', $id)->delete();
            RkpDesa::find($id)->delete();

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

    public function getUsulan(Request $request)
    {
        // $data['usulan'] = UsulanDesa::where('status','USULAN')->orderBy('bidang_id', 'ASC')->get();
        // dd($request);


        // return response()->json($data);
        if ($request->type != "select2") {
            $data = UsulanDesa::select('kegiatan_eplanning.id', 'bidang_eplanning.nama_bidang as nama_bidang', 'kegiatan_eplanning.nama_kegiatan as nama_kegiatan', 'kegiatan_eplanning.estimated_time as estimated_time', 'wilayah.dusun as dusun', 'kegiatan_eplanning.manfaat', 'kegiatan_eplanning.volume', 'kegiatan_eplanning.jumlah', 'kegiatan_eplanning.wilayah_id', 'kegiatan_eplanning.sub_bidang_id', 'kegiatan_eplanning.status')
                ->join('bidang_eplanning','bidang_eplanning.id','=','kegiatan_eplanning.sub_bidang_id')
                ->join('wilayah', 'wilayah.id', '=', 'kegiatan_eplanning.wilayah_id')
                ->where('status', 'USULAN DESA')
                ->orderBy('kegiatan_eplanning.nama_kegiatan', 'ASC')
                ->get();

        }else {
            $data = UsulanDesa::select('kegiatan_eplanning.id', 'bidang_eplanning.nama_bidang as nama_bidang', 'kegiatan_eplanning.nama_kegiatan as nama_kegiatan', 'kegiatan_eplanning.estimated_time as estimated_time', 'wilayah.dusun as dusun', 'kegiatan_eplanning.manfaat', 'kegiatan_eplanning.volume', 'kegiatan_eplanning.jumlah', 'kegiatan_eplanning.wilayah_id', 'kegiatan_eplanning.sub_bidang_id', 'kegiatan_eplanning.status')
                ->join('bidang_eplanning','bidang_eplanning.id','=','kegiatan_eplanning.sub_bidang_id')
                ->join('wilayah', 'wilayah.id', '=', 'kegiatan_eplanning.wilayah_id')
                ->where('status', 'USULAN DESA')
                ->where('kegiatan_eplanning.nama_kegiatan', 'like', "%$request->search%")
                ->orderBy('kegiatan_eplanning.nama_kegiatan', 'ASC')
                ->get();
        }
        return response()->json($data);
    }

    public function updateToUsulan($id)
    {
        try {
            $activity = UsulanDesa::find($id);
            $activity->status = "USULAN DESA";
            $activity->rkp_id = NULL;
            $activity->attachment = NULL;
            $activity->save();
            return response(null, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return ["ERROR", $th];
        }
    }

    public function reportRkp($id)
    {
        $data['rkp'] = RkpDesa::select('rkp_desa.tahun', 'desa.nama_desa', 'desa.nama_kecamatan','desa.nama_kabupaten','desa.nama_propinsi', 'rkp_desa.created_at')
            ->join('desa', 'desa.id', '=', 'rkp_desa.desa_id')
            ->find($id);
        $data['bidang'] = BidangEplanning::where('parent_id', NULL)
                                        ->whereHas('chaild', function($chaild) use ($id) {
                                            $chaild->whereHas('activity', function($query) use ($id) {
                                                $query->where('rkp_id', '=', $id);
                                            });
                                        })
                                ->with(['chaild' => function($chaild) use($id){
                                        $chaild->with(['activity' => function($query) use ($id) {
                                            $query->where('rkp_id', '=', $id);
                                        }]);
                                    }
                                ])->orderBy('kode_bidang')->get();

        // $data['sub_bidang'] = BidangEplanning::where('parent_id', NULL)
        //                     ->with(['activity' => function($query) use ($id) {
        //                        $query->where('rkp_id', '=', $id);
        //                     }])
        //                     ->get();
        $data['grand_total'] = UsulanDesa::where('rkp_id', $id)->sum('kegiatan_eplanning.jumlah');

        //return response()->json($data);
        return view('e-planning.export-pdf.rkp-report-2', [
            'data' => $data
        ]);
    }

    public function index2(Request $request)
    {
        if ($request->type == 'datatable') {
            $data = RkpDesa::orderBy('tahun', 'DESC')->get();

            return datatables()->of($data)
            ->addColumn('action', function ($data) {
                return '<div class="btn-group">
                            <button type="button" class="btn btn-rounded btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-gear"></i> Action <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="' . route('rkp-desa.edit', $data->id) . '">Edit</a></li>
                                <li><a data-id="' . $data->id . '" data-label="RKP Desa" data-url="/e-planning/rkp-desa/' . $data->id . '" class="delete-item text-danger">Delete</a></li>
                            </ul>
                        </div>';
            })
            ->editColumn('tahun', function ($data){
                return '<a href="'.route('rkp-desa.show', $data->id).'" class="text-primary">'.$data->tahun.'</a>';
            })
            ->addColumn('print', function($data){
                return '<a href="'.route('report.rkp', $data->id).'" class="btn btn-rounded btn-primary text-white" target="_blank">
                            <i class="fa fa-print"></i> Print RKP <span class="caret"></span>
                        </a>';
            })
            ->rawColumns(['action', 'tahun', 'print'])
            ->make(true);
        }
        $data['page_title'] = "RKP Desa";
        return view('e-planning.rkp-2.index', $data);
    }

    public function create2()
    {
        $data['bidang'] = BidangEplanning::where('parent_id', NULL)->orderBy('nama_bidang', 'ASC')->get();
        $data['sumber_dana'] = RkpSumberDana::orderBy('nama','ASC')->get();
        $data['lokasi'] = Wilayah::orderBy('dusun', 'ASC')->get();
        return view('e-planning.rkp-2.create',[
            'page_title' => 'Buat RKP',
            'data' => $data
        ]);
    }

    public function uploadAttachment(Request $request)
    {
                        //VALIDASI DATA YANG DIKIRIMKAN DARI FORM
    $this->validate($request, [
        'attachment' => 'required'
    ]);

    //JIKA FILE TERSEDIA
    if ($request->hasFile('attachment')) {
        $file = $request->file('attachment'); //MAKA KITA GET FILENYA
        //BUAT CUSTOM NAME YANG DIINGINKAN, DIMANA FORMATNYA KALI INI ADALH EMAIL + TIME DAN MENGGUNAKAN ORIGINAL EXTENSION
        $filename = $request->email . 'gls' . time() . '.' . $file->getClientOriginalExtension();
        //UPLOAD MENGGUNAKAN CONFIG S3, DENGAN FILE YANG DIMASUKKAN KE DALAM FOLDER IMAGES
        //SECARA OTOMATIS AMAZON AKAN MEMBUAT FOLDERNYA JIKA BELUM ADA
        $publicURI = "https://" . env('AWS_BUCKET') .".". env('AWS_URL') . "/attachment"."/" .$filename;
        Storage::disk('s3')->put('attachment/' . $filename, file_get_contents($file), 'public');
        //https://glsdesa.s3-ap-southeast-1.amazonaws.com/images/-1607082298.jpg
        //SIMPAN INFORMASI USER KE DATABASE
        //DAN profile YANG DISIMPAN HANYALAH FILENAME-NYA SAJA
        //REDIRECT KE HALAMAN YANG SAMA DAN BERIKAN NOTIFIKASI
        return $publicURI;
    }
    return redirect()->back()->with(['error' => 'Gambar Belum Dipilih']);
    }
}
