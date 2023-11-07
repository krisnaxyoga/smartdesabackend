<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\UsulanDusun;
use App\UsulanKegiatanDusun;
use App\Wilayah;
use App\Desa;
use App\Kelompok;
use Auth;
use Illuminate\Support\Facades\Response as Download;
use DB;

class UsulanDusunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->type == 'datatable') {

            $data = UsulanDusun::where('usulan_dusun.id', '!=', -1)
                                ->select('usulan_dusun.*','wilayah.dusun as nama_dusun','kelompok.nama as nama_kelompok')
                                ->leftJoin('wilayah','wilayah.id','=','usulan_dusun.pengusul_id')
                                ->leftJoin('kelompok','kelompok.id','=','usulan_dusun.pengusul_id');
            if (
                $request->has('pengusul') &&
                $request->pengusul !== null &&
                $request->pengusul !== ''
            ) {
                $data->where(function($query) use ($request){
                    $query->where(function($dusunQuery) use ($request){
                        $dusunQuery->where('wilayah.dusun',  'LIKE', "%{$request->pengusul}%")
                            ->where('usulan_dusun.pengusul_type','=','DUSUN');
                    })
                    ->orWhere(function($klpQuery) use ($request){
                        $klpQuery->where('kelompok.nama',  'LIKE', "%{$request->pengusul}%")
                            ->where('usulan_dusun.pengusul_type','=','KELOMPOK');
                    });

                });
            }
            if (
                $request->has('search_by') &&
                $request->has('keyword') &&
                $request->search_by !== null &&
                $request->keyword !== null &&
                $request->search_by !== '' &&
                $request->keyword !== ''
            ) {
                $data->where($request->search_by, 'LIKE', "%{$request->keyword}%");
            }
            return datatables()->of($data)
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group">
                                <button type="button" class="btn btn-rounded btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-gear"></i> Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="' . route('report.usulan-dusun', $data->id) . '" target="_blank">Print</li>
                                    <li><a href="' . route('usulan-dusun.edit', $data->id) . '">Edit</a></li>
                                    <li><a data-id="' . $data->id . '" data-label="Usulan Dusun" data-url="/e-planning/usulan-dusun/' . $data->id . '" class="delete-item text-danger">Delete</a></li>
                                </ul>
                            </div>';
                })
                ->editColumn('pengusul', function($data){
                    return  '<a href="'. route('usulan-dusun.show',$data->id) .'" class="text-primary">'. $data->pengusul .'</a>';
                })
                ->editColumn('attachment', function($data){
                    return  '<a data-id="' . $data->id . '" data-url="/e-planning/download-asset-usulan-dusun/' . $data->id . '" class="download-item btn primary text-white"><i class="fa fa-download"></i></a>';
                })
                ->rawColumns(['action','pengusul','attachment'])
                ->make(true);
        }
        return view('e-planning.usulan-dusun.index', [
            'page_title' => 'Usulan Masyarakat'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['wilayah']  = Wilayah::select('wilayah.id','wilayah.desa_id','wilayah.dusun as nama')->get();
        $data['kelompok'] = Kelompok::select('kelompok.*','kelompok_master.kelompok as kategori')
                                    ->join('kelompok_master','kelompok_master.id', '=', 'kelompok.kelompok_master_id')
                                    ->get();
        //return response()->json($data);
        return view('e-planning.usulan-dusun.create',[
            'page_title' => 'Tambah Usulan Masyarakat',
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
        //return response()->json($request);
        // dd($request);
        $this->validate($request, [
            'tahun' => 'required|max: 4',
            'pengusul_id' => 'required',
            'nama_kegiatan' => 'required',
            'lokasi' => 'required',
            'volume' => 'required',
            'satuan' => 'required',
            'lk' => 'required',
            'pr' => 'required',
            'artm' => 'required',
        ]);

        $dataNama = $request->nama_kegiatan;
        $dataLokasi = $request->lokasi;
        $dataVolume = $request->volume;
        $dataSatuan = $request->satuan;
        $dataLk = $request->lk;
        $dataPr = $request->pr;
        $dataArtm = $request->artm;

        $pengusul = $request->pengusul_id;
        $check_wilayah = Wilayah::where('dusun', $pengusul)->first();
        $check_kelompok = Kelompok::where('nama', $pengusul)->first();

        if ($request->file('attachment') !== null) {
            $url = $this->uploadFileToS3($request);
        } else {
            $url = null;
        }

        DB::beginTransaction();
        try {

            if ($check_wilayah != null) {
                $usulan = UsulanDusun::create([
                    'pengusul_type' => 'DUSUN',
                    'pengusul_id' => $check_wilayah->id,
                    'tahun' => $request->tahun,
                    'keterangan' => $request->keterangan,
                    'attachment' => $url
                ]);

            } else {
                $usulan = UsulanDusun::create([
                    'pengusul_type' => 'KELOMPOK',
                    'pengusul_id' => $check_kelompok->id,
                    'tahun' => $request->tahun,
                    'keterangan' => $request->keterangan,
                    'attachment' => $url
                ]);
            }
            // $usulan = UsulanDusun::create($r);
            foreach ($dataNama as $key => $value) {
                $data = [
                    'usulan_dusun_id' => $usulan->id,
                    'nama_kegiatan' => $dataNama[$key],
                    'lokasi' =>$dataLokasi[$key],
                    'volume' => $dataVolume[$key],
                    'satuan' => $dataSatuan[$key],
                    'penerima_lk' => $dataLk[$key],
                    'penerima_pr' => $dataPr[$key],
                    'penerima_artm' => $dataArtm[$key],
                    'status' => "USULAN DUSUN"
                ];
                // dd($data);
                UsulanKegiatanDusun::create($data);
            }
            DB::commit();
            return redirect()->route('usulan-dusun.index');
        } catch (\Throwable $e) {
            // dd("ERROR", $e);
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
        $data = UsulanDusun::select('usulan_dusun.*', 'desa.nama_desa as nama_desa')
                                ->join('desa', 'desa.id', '=', 'usulan_dusun.desa_id')
                                ->where('usulan_dusun.id', $id)
                                ->first();
        if ($request->type == "datatable") {

            $dataUsulan = UsulanKegiatanDusun::select('kegiatan_eplanning.nama_kegiatan', 'kegiatan_eplanning.volume', 'kegiatan_eplanning.penerima_lk', 'kegiatan_eplanning.penerima_pr', 'kegiatan_eplanning.penerima_artm', 'kegiatan_eplanning.lokasi', 'kegiatan_eplanning.satuan')
                ->where('usulan_dusun_id', $id)
                ->get();

            return datatables()->of($dataUsulan)
            ->make(true);

        }
        // dd($data['usulanDusun']);
        return view('e-planning.usulan-dusun.detail', [
            'page_title' => "Detail Usulan",
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
        $data['wilayah']  = Wilayah::select('wilayah.id','wilayah.desa_id','wilayah.dusun as nama')->get();
        $data['kelompok'] = Kelompok::select('kelompok.*','kelompok_master.kelompok as kategori')
                                    ->join('kelompok_master','kelompok_master.id', '=', 'kelompok.kelompok_master_id')
                                    ->get();
        $data['usulanDusun'] = UsulanDusun::find($id);
        if ($request->type == 'edit') {
            $data = UsulanKegiatanDusun::select('id', 'nama_kegiatan', 'volume', 'satuan', 'lokasi', 'penerima_lk', 'penerima_pr', 'penerima_artm')
            ->where('usulan_dusun_id', $id)
            ->orderBy('usulan_dusun_id', 'ASC')
            ->get();
            return response()->json($data);
        }

        return view('e-planning.usulan-dusun.edit',[
            'page_title' => 'Edit Usulan Masyarakat',
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
        // dd($request, $id);
        $this->validate($request, [
            'tahun' => 'required|max: 4',
            'pengusul_id' => 'required',
            'nama_kegiatan' => 'required',
            'lokasi' => 'required',
            'volume' => 'required',
            'satuan' => 'required',
            'lk' => 'required',
            'pr' => 'required',
            'artm' => 'required',
        ]);

        //$r = $request->only('tahun', 'wilayah_id');

        $dataNama = $request->nama_kegiatan;
        $dataLokasi = $request->lokasi;
        $dataVolume = $request->volume;
        $dataSatuan = $request->satuan;
        $dataLk = $request->lk;
        $dataPr = $request->pr;
        $dataArtm = $request->artm;

        $pengusul = $request->pengusul_id;
        $check_wilayah = Wilayah::where('dusun', $pengusul)->first();
        $check_kelompok = Kelompok::where('nama', $pengusul)->first();

        DB::beginTransaction();
        try {
            $usulan = UsulanDusun::find($id);

            if ($check_wilayah != null) {
                $usulan->update([
                    'pengusul_type' => 'DUSUN',
                    'pengusul_id' => $check_wilayah->id,
                    'tahun' => $request->tahun,
                    'keterangan' => $request->keterangan
                ]);

            } else {
                $usulan->update([
                    'pengusul_type' => 'KELOMPOK',
                    'pengusul_id' => $check_kelompok->id,
                    'tahun' => $request->tahun,
                    'keterangan' => $request->keterangan
                ]);
            }

            if ($request->file('attachment') !== null) {
                $url = $this->uploadFileToS3($request);
                $usulan->update(['attachment' => $url]);
            }

            // UsulanDusun::find($id)->update($r);
            UsulanKegiatanDusun::where('usulan_dusun_id', $id)->delete();
            foreach ($dataNama as $key => $value) {
                $data = [
                    'usulan_dusun_id' => $id,
                    'nama_kegiatan' => $dataNama[$key],
                    'lokasi' =>$dataLokasi[$key],
                    'volume' => $dataVolume[$key],
                    'satuan' => $dataSatuan[$key],
                    'penerima_lk' => $dataLk[$key],
                    'penerima_pr' => $dataPr[$key],
                    'penerima_artm' => $dataArtm[$key],
                    'status' => "USULAN DUSUN"
                ];
                UsulanKegiatanDusun::create($data);
            }
            DB::commit();
            return redirect()->route('usulan-dusun.index');
        } catch (\Throwable $e) {
            DB::rollback();
            return back()->with('error', "Error on file {$e->getFile()} line {$e->getLine()}: {$e->getMessage()}");
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
            UsulanKegiatanDusun::where('usulan_dusun_id',$id)->delete();
            UsulanDusun::find($id)->delete();

            if ($request->ajax()) {
                return response()->json([
                    'error' => false,
                    'message' => 'Usulan Masyarakat successfully deleted.'
                ]);
            }

            return redirect()->back()->with('success', 'Usulan Masyarakat successfully deleted.');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'error' => false,
                    'message' => 'Usulan Desa failed to delete.'
                ]);
            }

            return redirect()->back()->with('error', 'Usulan Masyarakat failed to delete.');
        }
    }

    public function deleteUsulanKegiatan($id)
    {
        try {
            UsulanKegiatanDusun::where('id', $id)->delete();
            return "Success";
        } catch (\Throwable $th) {
            return response()->json([
                'error' => false,
                'message' => 'Usulan Kegiatan Masyarakat failed to delete.'
            ]);
        }
    }

    public function reportUsulanDusun($id)
    {
        $data['usulan'] = UsulanDusun::select('usulan_dusun.*','desa.nama_desa')
                            ->join('desa', 'desa.id', '=', 'usulan_dusun.desa_id')
                            ->find($id);

        $data['kegiatan'] = UsulanKegiatanDusun::select('nama_kegiatan', 'lokasi', 'volume', 'satuan', 'penerima_lk', 'penerima_pr', 'penerima_artm')
                            ->where('status', 'USULAN DUSUN')
                            ->where('usulan_dusun_id', $id)
                            ->get();

        $data['desa'] = Desa::find(auth()->user()->desa_id);

        return view('e-planning.export-pdf.usulan-dusun-report', [
            'data' => $data
        ]);
    }

    public function uploadFileToS3($request)
    {
        $file = $request->file('attachment');

        // Generate streamed file.
        $s3 = \Storage::disk('s3');

        $fileName = md5(time()) . md5($file->getClientOriginalName());
        $fileName = $s3->putFile('attachment', $file, 'public');

        return  $fileName;

        $publicURI = "https://" . env('AWS_URL') . "/" . env('AWS_BUCKET') . "/" . $fileName;
        return $publicURI;
    }

    public function downloadAsset(Request $request, $id)
    {
        $file = UsulanDusun::find($id);
        if ($file->attachment == null) {

            if ($request->ajax()) {
                return response()->json([
                    'error' => false,
                    'message' => 'Attachment cannot be downloaded.'
                ]);
            }

            return redirect()->back()->with('error', 'Attachment cannot be downloaded.');

        } else{
            $headers = [
                'Content-Type'        => 'Content-Type: application/pdf',
                'Content-Disposition' => 'attachment; filename="'. $file->attachment .'"',
            ];
            return Download::make(\Storage::disk('s3')->get($file->attachment), 200, $headers);
        }
    }


}
