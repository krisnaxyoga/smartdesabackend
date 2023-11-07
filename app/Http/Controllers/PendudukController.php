<?php

namespace App\Http\Controllers;

use App\Cacat;
use App\CaraKB;
use App\Exports\PendudukExport;
use App\Exports\PendudukTemplate\TemplateExport;
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
use DB;
use DataTables;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class PendudukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['page_title'] = "Penduduk";
        $data['listWilayah'] = Wilayah::orderBy('dusun', 'asc')->get();
        $data['listSex'] = PendudukSex::get();
        $data['listUmur'] = PendudukUmur::get();
        $data['listPendidikanDitempuh'] = PendudukPendidikan::get();
        $data['listPendidikanKK'] = PendudukPendidikanKK::get();
        $data['listPekerjaan'] = PendudukPekerjaan::get();
        $data['listStatusDasar'] = StatusDasar::get();
        $data['listStatus'] = PendudukStatus::get();
        $data['listAgama'] = PendudukAgama::get();
        $data['listSuku'] = Suku::get();
        $data['listGolonganDarah'] = GolonganDarah::get();
        $data['listWarganegara'] = PendudukWarganegara::get();
        //
        if ($request->type == 'datatable') {
            // $penduduks = Penduduk::orderBy('id', 'ASC')
            //     ->with([
            //         'pekerjaan',
            //         'status_kawin'
            //     ])
            //     ->get();

            $penduduks = Penduduk::select("*", DB::raw('floor(datediff(curdate(),tanggallahir) / 365) as umur_penduduk'));

            return datatables()->of($penduduks)
                ->filter(function ($query) use ($request) {
                    if ($request->status != 0) {
                        $query->where('status', $request->status);
                    }
                    if ($request->pekerjaan != 0) {
                        $query->where('pekerjaan_id', $request->pekerjaan);
                    }

                    if ($request->umur != -1) {
                        // $umur = PendudukUmur::find($request->umur);
                        $umur = $request->umur;
                        $query->whereRaw("floor(datediff(curdate(),tanggallahir) / 365) >= $umur")->whereRaw("floor(datediff(curdate(),tanggallahir) / 365) <= $umur");
                    }

                    if ($request->warga_negara != 0) {
                        $query->where('warga_negara_id', $request->warga_negara);
                    }

                    if ($request->pendidikan_tempuh != 0) {
                        $query->where('pendidikan_sedang_id', $request->pendidikan_tempuh);
                    }

                    if ($request->golongan_darah != 0) {
                        $query->where('golongan_darah_id', $request->golongan_darah);
                    }

                    if ($request->agama != 0) {
                        $query->where('agama_id', $request->agama);
                    }

                    if ($request->pendidikan != 0) {
                        $query->where('pendidikan_kk_id', $request->pendidikan);
                    }

                    if ($request->jenis_kelamin != 0) {
                        $query->where('sex', $request->jenis_kelamin);
                    }

                    if ($request->wilayah != 0) {
                        $query->where('dusun_id', $request->wilayah);
                    }

                    if ($request->status_dasar != 0) {
                        $query->where('status_dasar', $request->status_dasar);
                    }

                    if ($request->keyword !== null) {
                        $query->where('nama', 'like', "%{$request->keyword}%")->orWhere('nik', 'like', "%{$request->keyword}%");
                    }
                })
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group"><button type="button" class="btn  btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-gear"></i> Action <span class="caret"></span></button><ul class="dropdown-menu"><li><a target="_blank" href="' . route('penduduk.edit', $data->id) . '">Edit Biodata</a></li> <li><a target="_blank" href="' . route('penduduk.status-dasar', $data->id) . '">Edit Status Dasar</a></li> <li><a href="#" data-toggle="modal" data-target="#pindah-dalam-desa-modal" data-id="' . $data->id . '">Pindah Dalam Desa</a></li> <li><a data-id="' . $data->id . '" data-label="penduduk" data-url="/penduduk/' . $data->id . '" class="delete-item text-danger">Delete</a></li></ul></div>';
                })
                ->editColumn('nik', function ($data) {
                    return '<a target="_blank" href="' . route('penduduk.show', [$data->id]) . '" class="text-primary">' . $data->nik . '</a>';
                })
                ->editColumn('no_kk_sebelumnya', function ($data) {
                    return '<a href="#" class="text-primary">' . $data->no_kk_sebelumnya . '</a>';
                })
                ->addColumn('pekerjaan', function ($data) {
                    return $data->pekerjaan ? $data->pekerjaan->nama : '-';
                    // return $data->umur_penduduk;
                })
                ->addColumn('kawin', function ($data) {
                    return $data->status_kawin ? $data->status_kawin->nama : '-';
                })
                ->rawColumns(['action', 'nik', 'no_kk_sebelumnya'])
                ->make(true);
        }
        return view('penduduk.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['page_title'] = "Tambah Penduduk";

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
        $data['listGolonganDarah'] = GolonganDarah::get();
        $data['listSakitMenahun'] = SakitMenahun::get();
        $data['listCacat'] = Cacat::get();
        $data['listCaraKB'] = CaraKB::get();
        $data['listJenisKelahiran'] = JenisKelahiran::get();
        $data['listTempatDilahirkan'] = TempatDilahirkan::get();
        $data['listPenolongKelahiran'] = PenolongKelahiran::get();
        $data['listKtpStatus'] = KtpStatus::get();
        $data['listHubungan'] = PendudukHubungan::get();

        return view('penduduk.create', $data);
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
        $req = $request->except(['_token', 'birth_date', 'birth_month', 'birth_year']);

        DB::rollback();
        DB::beginTransaction();

        try {
            if ($request->file('profile') !== null) {
                $url = $this->uploadFileToS3($request);
                // dd($url);
                $req['foto'] = $url;
            }

            // Token.
            $req['token'] = hash_hmac('sha256', rand(11111111, 99999999) . microtime(), 'simadu-colony');
            $req['tanggallahir'] = date("Y-m-d", mktime(
                0,
                0,
                0,
                $request->get('birth_month'),
                $request->get('birth_date'),
                $request->get('birth_year')
            ));

            $data = Penduduk::create($req);

            if ((((bool) $request->use_map))) {
                $pendudukMap = PendudukMap::create([
                    'lat' => $req['lat'],
                    'lng' => $req['lng'],
                    'penduduk_id' => $data->id,
                ]);
            }



            DB::commit();

            if (
                $request->has('referrer') &&
                $request->referrer !== '' &&
                strpos($request->referrer, url('/')) !== false
            ) {
                return redirect($request->referrer);
            }

            return redirect()->route('penduduk.index');
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
    public function show($id)
    {

        $data['penduduk'] = Penduduk::find($id);

        if ($data['penduduk'] == null) {
            abort(404);
        }

        return view('penduduk.detail', $data);
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
        //

        $data['penduduk'] = Penduduk::find($id);
        $data['listSuku'] = Suku::get();

        $data['page_title'] = "Edit " . $data['penduduk']->nik;
        $data['listDusun'] = Wilayah::get();
        $data['listAgama'] = PendudukAgama::get();
        $data['listPekerjaan'] = PendudukPekerjaan::get();
        $data['listPendidikan'] = PendudukPendidikan::get();
        $data['listPendidikanKK'] = PendudukPendidikanKK::get();
        $data['listSex'] = PendudukSex::get();
        $data['listStatus'] = PendudukStatus::get();
        $data['listWarganegara'] = PendudukWarganegara::get();
        $data['listKawin'] = PendudukKawin::get();
        $data['listGolonganDarah'] = GolonganDarah::get();
        $data['listSakitMenahun'] = SakitMenahun::get();
        $data['listCacat'] = Cacat::get();
        $data['listCaraKB'] = CaraKB::get();
        $data['listJenisKelahiran'] = JenisKelahiran::get();
        $data['listTempatDilahirkan'] = TempatDilahirkan::get();
        $data['listPenolongKelahiran'] = PenolongKelahiran::get();
        $data['listKtpStatus'] = KtpStatus::get();
        $data['listHubungan'] = PendudukHubungan::get();

        return view('penduduk.edit', $data);
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
        $penduduk = Penduduk::find($id);

        if (!$penduduk) {
            abort(404);
        }

        DB::rollback();
        DB::beginTransaction();

        try {
            $penduduk = new Penduduk();
            $fillable = $penduduk->getFillable();
            $values = $request->only($fillable);
            $values['tanggallahir'] = date("Y-m-d", mktime(
                0,
                0,
                0,
                $request->get('birth_month'),
                $request->get('birth_date'),
                $request->get('birth_year')
            ));

            $data = Penduduk::where('id', $id)->update($values);

            if ($request->file('profile') !== null) {
                $url = $this->uploadFileToS3($request);
                // dd($url);
                Penduduk::where('id', $id)->update(['foto' => $url]);
                $p = Penduduk::where('id', $id)->first();
                // dd($p->toArray());
            }
            // dd("nuill");

            if ((((bool) $request->use_map))) {
                $map = PendudukMap::where('penduduk_id', $id)->first();
                if (!$map) {
                    $pendudukMap = PendudukMap::create([
                        'lat' => $request->get('lat'),
                        'lng' => $request->get('lng'),
                        'penduduk_id' => $id,
                    ]);
                } else {
                    $pendudukMap = PendudukMap::where('penduduk_id', $id)->update([
                        'lat' => $request->get('lat'),
                        'lng' => $request->get('lng'),
                    ]);
                }
            }




            DB::commit();

            if (
                $request->has('referrer') &&
                $request->referrer !== '' &&
                strpos($request->referrer, url('/')) !== false
            ) {
                return redirect($request->referrer);
            }

            return redirect()->route('penduduk.index');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage() . " at line " . $e->getLine());
            return redirect()->back()->withErrors([$e->getMessage() . " at line " . $e->getLine()]);
        } catch (\Throwable $e) {
            DB::rollback();
            dd($e->getMessage() . " at line " . $e->getLine());
            return redirect()->back()->withErrors([$e->getMessage() . " at line " . $e->getLine()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Penduduk::find($id)->delete();
    }

    public function toJson($id)
    {
        $data = Penduduk::find($id);
        return response()->json($data);
    }

    public function updateJson(Request $request, $id)
    {
        $penduduk = Penduduk::find($id);

        if (!$penduduk) {
            return response()->json(['error' => true, 'message' => 'Data not Found']);
        }


        $penduduk->update([
            'kk_level' => $request->kk_level
        ]);

        return response()->json([
            'error' => false
        ]);
    }


    public function pecahKK(Request $request, $id)
    {
        $penduduk = Penduduk::find($id);

        if (!$penduduk) {
            return response()->json(['error' => true, 'message' => 'Data not Found']);
        }


        $penduduk->update([
            'id_kk' => 0
        ]);

        return response()->json([
            'error' => false
        ]);
    }

    public function pendudukTanpaKK()
    {
        $penduduk = Penduduk::where('id_kk', 0)->orWhere('id_kk', null)->get();
        return response()->json($penduduk);
    }

    public function uploadFileToS3($request)
    {
                  //VALIDASI DATA YANG DIKIRIMKAN DARI FORM
    $this->validate($request, [
        'profile' => 'required|image|mimes:jpg,jpeg,png'
    ]);

    //JIKA FILE TERSEDIA
    if ($request->hasFile('profile')) {
        $file = $request->file('profile'); //MAKA KITA GET FILENYA
        //BUAT CUSTOM NAME YANG DIINGINKAN, DIMANA FORMATNYA KALI INI ADALH EMAIL + TIME DAN MENGGUNAKAN ORIGINAL EXTENSION
        $filename = $request->email . 'gls' . time() . '.' . $file->getClientOriginalExtension();
        //UPLOAD MENGGUNAKAN CONFIG S3, DENGAN FILE YANG DIMASUKKAN KE DALAM FOLDER IMAGES
        //SECARA OTOMATIS AMAZON AKAN MEMBUAT FOLDERNYA JIKA BELUM ADA
        $publicURI = "https://" . env('AWS_BUCKET') .".". env('AWS_URL') . "/penduduk"."/" .$filename;
        Storage::disk('s3')->put('penduduk/' . $filename, file_get_contents($file), 'public');
        //https://glsdesa.s3-ap-southeast-1.amazonaws.com/images/-1607082298.jpg
        //SIMPAN INFORMASI USER KE DATABASE
        //DAN profile YANG DISIMPAN HANYALAH FILENAME-NYA SAJA
        //REDIRECT KE HALAMAN YANG SAMA DAN BERIKAN NOTIFIKASI
        return $publicURI;
    }
    return redirect()->back()->with(['error' => 'Gambar Belum Dipilih']);
    }

    public function statusDasar($penduduk)
    {
        $penduduk = Penduduk::find($penduduk);
        $title = "Ubah Status Dasar - " . $penduduk->nama;

        $status_dasar = StatusDasar::get();

        return view('penduduk.status-dasar.edit', [
            'penduduk' => $penduduk,
            'page_title' => $title,
            'status_dasar' => $status_dasar,
        ]);
    }

    public function updateStatusDasar(Request $request, $penduduk)
    {
        $penduduk = Penduduk::find($penduduk);
        DB::rollback();

        DB::beginTransaction();

        try {
            $log = [
                'tgl_peristiwa' => $request->tgl_peristiwa,
                'penduduk_id' => $penduduk->id,
                'catatan' => $request->catatan,
                'detail_id' => $request->status_dasar,
                'type' => "STATUS_DASAR",
                'no_kk' => $penduduk->keluarga ? $penduduk->keluarga->no_kk : $penduduk->no_kk_sebelumnya,
                'nama_kk' => $penduduk->keluarga ? $penduduk->keluarga->kepalaKeluarga->nama : '-'
            ];


            $penduduk->update([
                'status_dasar' => $request->status_dasar
            ]);

            LogPenduduk::create($log);


            DB::commit();
            return redirect()->route('penduduk.index');
        } catch (\Exception $e) {
            DB::rollback();


            return response()->json([
                'error' => true,
                'message' => 'Error PendudukController :  ' . $e->getMessage() . " at line " . $e->getLine()
            ]);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json([
                'error' => true,
                'message' => 'Error PendudukController :  ' . $e->getMessage() . " at line " . $e->getLine()
            ]);
        }
    }

    public function checkPendudukKK($id)
    {
        $penduduk = Penduduk::find($id);

        if ($penduduk->id_kk == 0) {
            return response()->json([
                'error' => false,
                'data' => $penduduk
            ]);
        } else {
            return response()->json([
                'error' => true,
                'data' => []
            ]);
        }
    }

    public function updatePindahDalamDesa(Request $request, $penduduk)
    {
        $penduduk = Penduduk::find($penduduk);

        $log = [
            'alamat_sebelumnya' => $penduduk->alamat_sekarang,
            'alamat_sekarang' => $request->alamat_sekarang,
            'dusun_id' => $request->dusun_id
        ];

        $penduduk->update($log);

        if ($penduduk) {
            return response()->json([
                'error' => false
            ]);
        }
    }

    public function export(Request $request)
    {
        if (env('APP_ENV') === 'local') {
            ini_set('memory_limit', '-1');
        }

        set_time_limit(0);
        if (($request->dusun_id) !== null) {
            return Excel::download(new PendudukExport($request), "Data Penduduk - " . date('d M Y') . ".xlsx"); //export data penduduk
        }
    }

    public function templateImport()
    {
        set_time_limit(0);
        return Excel::download(new TemplateExport, "Template Penduduk - " . date('d M Y') . ".xlsx");
    }

    public function import(Request $request)
    {
        set_time_limit(0);
        $this->validate($request, [
            'excel_file' => "required"
        ]);
        Excel::import(new PendudukImport, request()->file('excel_file'));
        // $data = Excel::toArray(new PendudukImport, request()->file('excel_file'));
        // return response()->json($data);
        return redirect()->route('penduduk.index')->with('success', 'Data Penduduk Berhasil di Import');
    }


}
