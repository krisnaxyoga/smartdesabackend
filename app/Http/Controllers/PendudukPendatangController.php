<?php

namespace App\Http\Controllers;

use App\DetailPendudukPendatang;
use Illuminate\Http\Request;

use App\GolonganDarah;
use App\Imports\PendudukImport;
use App\JenisKelahiran;
use App\KtpStatus;
use App\LogPenduduk;
use App\Penduduk;
use App\PendudukAgama;
use App\PendudukHubungan;
use App\PendudukKawin;
use App\PendudukMap;
use App\PendudukPekerjaan;
use App\PendudukPendidikan;
use App\PendudukPendidikanKK;
use App\PendudukSex;
use App\PendudukStatus;
use App\PendudukUmur;
use App\PendudukWarganegara;
use App\PenolongKelahiran;
use App\SakitMenahun;
use App\StatusDasar;
use App\Suku;
use App\TempatDilahirkan;
use App\Wilayah;
use App\JenisTempatTinggal;
use App\Village;
use App\PendudukPendatang;
use DB;
use App\DesaPamong;
use App\Desa;
use PDF;
use DataTables;
use Illuminate\Support\Facades\Storage;

class PendudukPendatangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['page_title'] = "Data Penduduk Pendatang";
        $data['listWilayah'] = Wilayah::orderBy('dusun', 'asc')->get();
        $data['listSex'] = PendudukSex::get();
        $data['listPendidikanKK'] = PendudukPendidikanKK::get();
        $data['listPekerjaan'] = PendudukPekerjaan::get();
        $data['listAgama'] = PendudukAgama::get();
        $data['listGolonganDarah'] = GolonganDarah::get();
        $data['listWarganegara'] = PendudukWarganegara::get();

        if ($request->type == 'datatable') {
            $data = PendudukPendatang::select('penduduk_pendatang.*','villages.name as desa_asal','penduduk_pekerjaan.nama as pekerjaan','penduduk_kawin.nama as kawin')
                        ->join('penduduk_kawin','penduduk_kawin.id','=','penduduk_pendatang.status_kawin_id')
                        ->join('penduduk_pekerjaan','penduduk_pekerjaan.id','=','penduduk_pendatang.pekerjaan_id')
                        ->join('villages','penduduk_pendatang.desa_asal_id','=','villages.id');
            return datatables()->of($data)
                ->filter(function ($query) use ($request) {
                    if ($request->pekerjaan != 0) {
                        $query->where('pekerjaan_id', $request->pekerjaan);
                    }
                    if ($request->warga_negara != 0) {
                        $query->where('warga_negara_id', $request->warga_negara);
                    }
                    if ($request->golongan_darah != 0) {
                        $query->where('golongan_darah_id', $request->golongan_darah);
                    }
                    if ($request->agama != 0) {
                        $query->where('agama_id', $request->agama);
                    }
                    if ($request->pendidikan != 0) {
                        $query->where('pendidikan_id', $request->pendidikan);
                    }
                    if ($request->jenis_kelamin != 0) {
                        $query->where('sex_id', $request->jenis_kelamin);
                    }
                    if ($request->wilayah != 0) {
                        $query->where('dusun_tinggal_id', $request->wilayah);
                    }
                    if ($request->keyword !== null) {
                        $query->where('penduduk_pendatang.nama', 'like', "%{$request->keyword}%");
                    }
                })
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group"><button type="button" class="btn  btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-gear"></i> Action <span class="caret"></span></button><ul class="dropdown-menu"><li><a target="_blank" href="' . route('penduduk-pendatang.edit', $data->id) . '">Edit Data</a></li> <li><a target="_blank" href="' . route('penduduk-pendatang.preview', $data->id) . '">Cetak STLD</a></li> <li><a data-id="' . $data->id . '" data-label="penduduk pendatang" data-url="/penduduk-pendatang/' . $data->id . '" class="delete-item text-danger">Delete</a></li></ul></div>';
                })
                ->editColumn('nik', function ($data) {
                    return '<a target="_blank" href="' . route('penduduk-pendatang.show',[$data->id]) . '" class="text-primary">' . $data->nik . '</a>';
                })
                ->rawColumns(['action', 'nik'])
                ->make(true);
        }
        return view('penduduk_pendatang.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = "Tambah Penduduk Pendatang";

        $data['listDusun'] = Wilayah::get();
        $data['listAgama'] = PendudukAgama::get();
        $data['listPekerjaan'] = PendudukPekerjaan::get();
        $data['listPendidikan'] = PendudukPendidikan::get();
        $data['listPendidikanKK'] = PendudukPendidikanKK::get();
        $data['listSex'] = PendudukSex::get();
        $data['listStatus'] = PendudukStatus::get();
        $data['listWarganegara'] = PendudukWarganegara::get();
        $data['listSuku'] = Suku::get();
        $data['listKawin'] = PendudukKawin::get();
        $data['listKeluarga'] = PendudukHubungan::get();
        $data['listGolonganDarah'] = GolonganDarah::get();
        $data['listSakitMenahun'] = SakitMenahun::get();
        $data['listJenisKelahiran'] = JenisKelahiran::get();
        $data['listTempatDilahirkan'] = TempatDilahirkan::get();
        $data['listPenolongKelahiran'] = PenolongKelahiran::get();
        $data['listKtpStatus'] = KtpStatus::get();
        $data['listHubungan'] = PendudukHubungan::get();
        $data['listTempatTinggal'] = JenisTempatTinggal::get();
        $data['listStaff'] = DesaPamong::get();

        return view('penduduk_pendatang.create', $data);
    }

    public function dataVillage(Request $request)
    {
        $data['listVillages'] = Village::select('villages.*','districts.name as district','regencies.name as regency','provinces.name as province')
        ->join('districts','villages.district_id','=','districts.id')
        ->join('regencies','districts.regency_id','=','regencies.id')
        ->join('provinces','regencies.province_id','=','provinces.id')
        ->where('villages.name', 'like', "%" . $request->search . "%")->limit(10)->get();
        return response()->json($data['listVillages']);
    }

    public function dataPenduduk(Request $request)
    {
        $data['listPenduduk'] = Penduduk::with('jenisKelamin','status_kawin','pendidikan','hubungan')->where('nik','like', "%" . $request->search ."%")->get();
        return response()->json($data['listPenduduk']);
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

        try {
            if ($request->file('photo') !== null) {
                $urlProfile = $this->uploadFileToS3($request);
            } else {
                $urlProfile = null;
            }

            if ($request->file('photo_ktp') !== null) {
                $urlKtp = $this->uploadFileKTP($request);
            } else {
                $urlKtp = null;
            }


            $data = PendudukPendatang::create([
                'nik' => $request->nik,
                'no_kk' => $request->no_kk,
                'nama' => $request->nama,
                'sex_id' => $request->sex_id,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'golongan_darah_id'=> $request->golongan_darah_id,
                'agama_id' => $request->agama_id,
                'status_kawin_id' => $request->status_kawin_id,
                'status_keluarga_id' => $request->status_keluarga_id,
                'pendidikan_id' => $request->pendidikan_id,
                'pekerjaan_id' => $request->pekerjaan_id,
                'warga_negara_id' => $request->warga_negara_id,
                'no_hp' => $request->no_hp,
                'email' => $request->email,
                'alasan_domisili' => $request->alasan_domisili,
                'alamat_asal' => $request->alamat_asal,
                'desa_asal_id' => $request->desa_asal_id,
                'dusun_tinggal_id' => $request->dusun_tinggal_id,
                'jenis_tempat_tinggal_id' => $request->jenis_tempat_tinggal_id,
                'alamat_tinggal' => $request->alamat_tinggal,
                'photo' => $urlProfile,
                'photo_ktp' => $urlKtp,
                'status_verifikasi' => $request->status_verifikasi,
                'tanggal_melapor' => $request->tanggal_melapor,
                'surat' => $request->surat,
                'no_surat_desa' => $request->no_surat_desa,
                'masa_berlaku' => $request->masa_berlaku,
                'staff_id' => $request->staff_id
            ]);


            if ($request->nik_detail != null) {
                $nik_anggota = $request->nik_detail;
                $nama_anggota = $request->nama_detail;
                $sex_anggota = $request->sex_detail;
                $tgl_lahir_anggota = $request->umur_detail;
                $status_kawin_anggota = $request->status_kawin_detail;
                $pendidikan_anggota = $request->pendidikan_detail;
                $status_keluarga_anggota = $request->status_keluarga_detail;
                $ket_anggota = $request->ket_detail;

                foreach ($nik_anggota as $key => $value) {
                    $anggota = new DetailPendudukPendatang();

                    $anggota->duktang_id = $data->id;
                    $anggota->nik = $nik_anggota[$key];
                    $anggota->nama = $nama_anggota[$key];
                    $anggota->sex_id = $sex_anggota[$key];
                    $anggota->tanggallahir = $tgl_lahir_anggota[$key];
                    $anggota->status_kawin_id = $status_kawin_anggota[$key];
                    $anggota->pendidikan_id = $pendidikan_anggota[$key];
                    $anggota->status_keluarga_id = $status_keluarga_anggota[$key];
                    $anggota->keterangan = $ket_anggota[$key];
                    $anggota->save();
                }
            }
            DB::commit();
            return redirect()->route('penduduk-pendatang.index');
        } catch (\Exception $e) {
            DB::rollback();
            // return response()->json($e->getMessage());
            return redirect()->back()->withErrors([$e->getMessage() . " at line " . $e->getLine()]);
        } catch (\Throwable $e) {
            DB::rollback();
            // return response()->json($e->getMessage());
            return redirect()->back()->withErrors([$e->getMessage() . " at line " . $e->getLine()]);
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
        $data['page_title'] = "Detail Data Penduduk Pendatang";
        $duktang = PendudukPendatang::find($id);
        $data['listSex'] = PendudukSex::get();
        $data['listKawin'] = PendudukKawin::get();
        $data['listPendidikan'] = PendudukPendidikan::get();
        $data['listPendidikanKK'] = PendudukPendidikanKK::get();
        $data['listHubungan'] = PendudukHubungan::get();
        $data['duktang'] = $duktang;
        $data['asal'] = Village::select('villages.*','districts.name as district','regencies.name as regency','provinces.name as province')
        ->join('districts','villages.district_id','=','districts.id')
        ->join('regencies','districts.regency_id','=','regencies.id')
        ->join('provinces','regencies.province_id','=','provinces.id')->where('villages.id',$duktang->desa_asal_id)->first();

        //return response()->json($data);

        if (isset($request->type) && $request->type == 'datatable') {

            $detail = DetailPendudukPendatang::where('duktang_id', $id)
                                            ->select('detail_penduduk_pendatang.*','penduduk_sex.nama as jenisKelamin','penduduk_kawin.nama as status_kawin','penduduk_pendidikan.nama as pendidikan','penduduk_hubungan.nama as hubungan')
                                            ->join('penduduk_sex','penduduk_sex.id','=','detail_penduduk_pendatang.sex_id')
                                            ->join('penduduk_kawin','penduduk_kawin.id','=','detail_penduduk_pendatang.status_kawin_id')
                                            ->join('penduduk_pendidikan','penduduk_pendidikan.id','=','detail_penduduk_pendatang.pendidikan_id')
                                            ->join('penduduk_hubungan','penduduk_hubungan.id','=','detail_penduduk_pendatang.status_keluarga_id')
                                            ->orderBy('id','DESC')->get();

            return datatables()->of($detail)
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group"><button type="button" class="btn  btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-gear"></i> Action <span class="caret"></span></button><ul class="dropdown-menu"><li><a data-toggle="modal" data-target="#edit-anggota-duktang-modal" data-id="'.$data->id.'">Edit</a></li> <li><a data-id="' . $data->id . '" data-label="data anggota keluarga" data-url="/anggota-duktang/' . $data->id . '" class="delete-item text-danger">Delete</a></li></ul></div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        } else {
            return view('penduduk_pendatang.show', $data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['duktang'] = PendudukPendatang::find($id);

        $data['listDusun'] = Wilayah::get();
        $data['listAgama'] = PendudukAgama::get();
        $data['listPekerjaan'] = PendudukPekerjaan::get();
        $data['listPendidikan'] = PendudukPendidikan::get();
        $data['listPendidikanKK'] = PendudukPendidikanKK::get();
        $data['listSex'] = PendudukSex::get();
        $data['listStatus'] = PendudukStatus::get();
        $data['listWarganegara'] = PendudukWarganegara::get();
        $data['listSuku'] = Suku::get();
        $data['listKawin'] = PendudukKawin::get();
        $data['listKeluarga'] = PendudukHubungan::get();
        $data['listGolonganDarah'] = GolonganDarah::get();
        $data['listSakitMenahun'] = SakitMenahun::get();
        $data['listJenisKelahiran'] = JenisKelahiran::get();
        $data['listTempatDilahirkan'] = TempatDilahirkan::get();
        $data['listPenolongKelahiran'] = PenolongKelahiran::get();
        $data['listKtpStatus'] = KtpStatus::get();
        $data['listHubungan'] = PendudukHubungan::get();
        $data['listTempatTinggal'] = JenisTempatTinggal::get();
        $data['listStaff'] = DesaPamong::get();

        $data['asal'] = Village::select('villages.*','districts.name as district','regencies.name as regency','provinces.name as province')
        ->join('districts','villages.district_id','=','districts.id')
        ->join('regencies','districts.regency_id','=','regencies.id')
        ->join('provinces','regencies.province_id','=','provinces.id')->where('villages.id', $data['duktang']->desa_asal_id)->first();

        $data['page_title'] = "Edit " . $data['duktang']->nik;
        return view('penduduk_pendatang.edit', $data);
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

        $duktang = PendudukPendatang::find($id);

        if(!$duktang) {
            abort(404);
        }

        try {
            $duktang= new PendudukPendatang();

            $fillable = $duktang->getFillable();
            $values = $request->only($fillable);

            $data = PendudukPendatang::where('id', $id)->update($values);

            if ($request->file('photo') !== null) {
                $urlProfile = $this->uploadFileToS3($request);
                PendudukPendatang::where('id',$id)->update(['photo' => $urlProfile]);
            }

            if ($request->file('photo_ktp') !== null) {
                $urlKtp = $this->uploadFileKTP($request);
                PendudukPendatang::where('id',$id)->update(['photo_ktp' => $urlKtp]);
            }

            return redirect()->route('penduduk-pendatang.index');
        } catch (\Exception $e) {
            DB::rollback();
            // return response()->json($e->getMessage());
            return redirect()->back()->withErrors([$e->getMessage() . " at line " . $e->getLine()]);
        } catch (\Throwable $e) {
            DB::rollback();
            // return response()->json($e->getMessage());
            return redirect()->back()->withErrors([$e->getMessage() . " at line " . $e->getLine()]);
        }
    }


    public function tambahAnggota($id)
    {
        $data['duktang'] = PendudukPendatang::find($id);
        $data['listSex'] = PendudukSex::get();
        $data['listKawin'] = PendudukKawin::get();
        $data['listPendidikan'] = PendudukPendidikan::get();
        $data['listPendidikanKK'] = PendudukPendidikanKK::get();
        $data['listHubungan'] = PendudukHubungan::get();
        $data['page_title'] = "Tambah Anggota Keluarga Yamg Ikut";
        return view('penduduk_pendatang.tambah-anggota', $data);
    }

    public function tambahTandatanganExport($id)
    {

        $data['duktang'] = PendudukPendatang::find($id);
        $data['page_title'] = "Cetak Surat Keterangan Tanda Lapor Diri (STLD)";
        return view('penduduk_pendatang.export-pdf.tandatangan', $data);
    }

    public function exportDuktang(Request $request, $id)
    {
        $data['duktang'] = PendudukPendatang::find($id);

        $data['duktang']->update([
            'masa_berlaku' => $request->masa_berlaku
        ]);

        $data['desa'] = Desa::where('id', $data['duktang']->desa_id)->first();

        $data['asal'] = Village::select('villages.*','districts.name as district','regencies.name as regency','provinces.name as province')
                                    ->join('districts','villages.district_id','=','districts.id')
                                    ->join('regencies','districts.regency_id','=','regencies.id')
                                    ->join('provinces','regencies.province_id','=','provinces.id')->where('villages.id', $data['duktang']->desa_asal_id)->first();

        $data['anggota_duktang'] = DetailPendudukPendatang::where('duktang_id', $id)->get();

        $pdf = PDF::loadView('penduduk_pendatang.export-pdf.duktang-surat', $data)->setPaper('a4','potrait');;
        return $pdf->stream($data['duktang']->nik . ' - ' . $data['duktang']->no_surat_desa . '.pdf');

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
            PendudukPendatang::find($id)->delete();
            DetailPendudukPendatang::where('duktang_id', $id)->delete();
            if ($request->ajax()) {
                return response()->json([
                    'error' =>false,
                    'message' => "Data Penduduk Pendatang successfully deleted."
                ]);
            }
            return redirect()->back()->with('success', 'Data Penduduk Pendatang successfully deleted.');
        } catch (\Exception $e) {

            if ($request->ajax()) {
                return response()->json([
                    'error' => false,
                    'message' => 'Data Penduduk Pendatang failed to delete.'
                ]);
            }

            return redirect()->back()->with('error', 'Data Penduduk Pendatang failed to delete.');
        }
    }

    public function uploadFileToS3($request)
    {
                             //VALIDASI DATA YANG DIKIRIMKAN DARI FORM
    $this->validate($request, [
        'photo' => 'required|image|mimes:jpg,jpeg,png'
    ]);

    //JIKA FILE TERSEDIA
    if ($request->hasFile('photo')) {
        $file = $request->file('photo'); //MAKA KITA GET FILENYA
        //BUAT CUSTOM NAME YANG DIINGINKAN, DIMANA FORMATNYA KALI INI ADALH EMAIL + TIME DAN MENGGUNAKAN ORIGINAL EXTENSION
        $filename = $request->email . 'gls' . time() . '.' . $file->getClientOriginalExtension();
        //UPLOAD MENGGUNAKAN CONFIG S3, DENGAN FILE YANG DIMASUKKAN KE DALAM FOLDER IMAGES
        //SECARA OTOMATIS AMAZON AKAN MEMBUAT FOLDERNYA JIKA BELUM ADA
        $publicURI = "https://" . env('AWS_BUCKET') .".". env('AWS_URL') . "/duktang"."/" .$filename;
        Storage::disk('s3')->put('duktang/' . $filename, file_get_contents($file), 'public');
        //https://glsdesa.s3-ap-southeast-1.amazonaws.com/images/-1607082298.jpg
        //SIMPAN INFORMASI USER KE DATABASE
        //DAN profile YANG DISIMPAN HANYALAH FILENAME-NYA SAJA
        //REDIRECT KE HALAMAN YANG SAMA DAN BERIKAN NOTIFIKASI
        return $publicURI;
    }
    return redirect()->back()->with(['error' => 'Gambar Belum Dipilih']);
    }
    public function uploadFileKTP($request)
    {
                        //VALIDASI DATA YANG DIKIRIMKAN DARI FORM
    $this->validate($request, [
        'photo_ktp' => 'required|image|mimes:jpg,jpeg,png'
    ]);

    //JIKA FILE TERSEDIA
    if ($request->hasFile('photo_ktp')) {
        $file = $request->file('photo_ktp'); //MAKA KITA GET FILENYA
        //BUAT CUSTOM NAME YANG DIINGINKAN, DIMANA FORMATNYA KALI INI ADALH EMAIL + TIME DAN MENGGUNAKAN ORIGINAL EXTENSION
        $filename = $request->email . 'gls' . time() . '.' . $file->getClientOriginalExtension();
        //UPLOAD MENGGUNAKAN CONFIG S3, DENGAN FILE YANG DIMASUKKAN KE DALAM FOLDER IMAGES
        //SECARA OTOMATIS AMAZON AKAN MEMBUAT FOLDERNYA JIKA BELUM ADA
        $publicURI = "https://" . env('AWS_BUCKET') .".". env('AWS_URL') . "/ktp"."/" .$filename;
        Storage::disk('s3')->put('ktp/' . $filename, file_get_contents($file));
        //https://glsdesa.s3-ap-southeast-1.amazonaws.com/images/-1607082298.jpg
        //SIMPAN INFORMASI USER KE DATABASE
        //DAN profile YANG DISIMPAN HANYALAH FILENAME-NYA SAJA
        //REDIRECT KE HALAMAN YANG SAMA DAN BERIKAN NOTIFIKASI
        return $publicURI;
    }
    return redirect()->back()->with(['error' => 'Gambar Belum Dipilih']);
    }


}
