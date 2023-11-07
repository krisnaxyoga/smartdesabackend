<?php

namespace App\Http\Controllers;

use App\Keluarga;

use App\KeluargaSejahtera;
use App\Penduduk;
use App\Desa;
use App\DesaPamong;
use App\PendudukHubungan;
use App\Program;
use App\ProgramPeserta;
use App\Wilayah;
use DB;
use Illuminate\Http\Request;


class KeluargaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->type == 'datatable') {
            // WITH RELATION
            // $keluarga = Keluarga::orderBy('id', 'ASC')
            //     ->whereHas('kepalaKeluarga')
            //     ->whereHas('dusun')
            //     ->with([
            //         'kepalaKeluarga',
            //         'dusun'
            //     ]);

            // WITHOUT RELATION
            $keluarga = Keluarga::select('keluarga.*', 'wilayah.dusun as nama_dusun', 'penduduk.nama as kepala_keluarga', 'penduduk.nik as kepala_nik', 'penduduk.alamat_sekarang as alamat_sekarang')
                ->join('wilayah', 'wilayah.id', '=', 'keluarga.id_cluster')
                ->join('penduduk', 'penduduk.nik', '=', 'keluarga.nik_kepala');

            return datatables()->of($keluarga)
                ->filter(function ($query) use ($request) {
                    if (
                        $request->has('id_cluster') &&
                        $request->id_cluster !== null &&
                        $request->id_cluster !== ''
                    ) {
                        $query->where('id_cluster', $request->id_cluster);
                    }
                    if (
                        $request->has('kelas_sosial') &&
                        $request->kelas_sosial !== null &&
                        $request->kelas_sosial !== ''
                    ) {
                        $query->where('kelas_sosial', $request->kelas_sosial);
                    }

                    if (
                        $request->has('search_by') &&
                        $request->has('keyword') &&
                        $request->search_by !== null &&
                        $request->keyword !== null &&
                        $request->search_by !== '' &&
                        $request->keyword !== ''
                    ) {
                        if ($request->search_by == 'tgl_daftar') {
                            $query->whereRaw("DATE(`tgl_daftar`) = '{$request->keyword}'");
                        } else {
                            $query->where($request->search_by, 'LIKE', "%{$request->keyword}%");
                        }
                    }
                })
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group">
                                <button type="button" class="btn btn-rounded btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-gear"></i> Action <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a target="_blank" href="' . route('keluarga.edit', $data->id) . '" data-id="' . $data->id . '">Edit</a></li>
                                    <li><a target="_blank" href="' . route('keluarga.anggota', $data->id) . '">Anggota Keluarga</a></li>
                                    <li><a data-id="' . $data->id . '" data-label="keluarga" data-url="/keluarga/' . $data->id . '" class="delete-item text-danger">Delete</a></li>
                                </ul>
                            </div>';
                })
                ->editColumn('kepala_nik', function ($data) {
                    return '<a target="_blank" href="/penduduk/' . $data->nik_kepala . '" class="text-primary">' . $data->kepala_nik . '</a>';
                })
                ->editColumn('no_kk', function ($data) {
                    return '<a target="_blank" href="' . route('keluarga.show', [$data->id]) . '" class="text-primary">' . $data->no_kk . '</a>';
                })

                ->rawColumns(['action', 'kepala_nik', 'no_kk'])
                ->make(true);
        }

        $data['page_title'] = "Keluarga";
        $data['listWilayah'] = Wilayah::orderBy('dusun', 'asc')->get();
        //
        $data['keluargaSejahtera'] = KeluargaSejahtera::get();
        $data['bantuan'] = Program::get();

        return view('keluarga.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['page_title'] = "Tambah Kepala Keluarga Baru";



        //List Data for Keluarga
        $data['pendudukTanpaKK'] = Penduduk::where('id_kk', 0)->get();
        $data['listDusun'] = Wilayah::get();


        return view('keluarga.create', $data);
    }

    public function anggota($id)
    {
        $data['page_title'] = "Daftar Anggota Keluarga";
        $data['keluarga'] = Keluarga::orderBy('id', 'ASC')
            ->with([
                'kepalaKeluarga',
                'dusun',
                'penduduk' => function ($penduduk) {
                    $penduduk->orderBy('kk_level', 'ASC')->orderBy('tanggallahir', 'ASC');
                }
            ])
            ->where('id', $id)->first();
        $data['hubungan'] = PendudukHubungan::get();
        return view('keluarga.anggota', $data);
    }


    public function tambahPenduduk(Request $request, $id)
    {
        $keluarga = Keluarga::find($id);

        if (!$keluarga)
            return response()->json(['error' => true, 'message' => 'Data not Found']);

        $penduduk = Penduduk::find($request->penduduk);

        if (!$penduduk)
            return response()->json(['error' => true, 'message' => 'Data not Found']);

        try {
            Penduduk::where('id', $request->penduduk)->update([
                'id_kk' => $id,
                'kk_level' => $request->kk_level
            ]);

            $keluarga->update([
                'id_kk' => 0
            ]);


            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json($e->getMessage());
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json($e->getMessage());
        }


        return response()->json([
            'error' => false
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
        $req = $request->all();

        DB::rollback();
        DB::beginTransaction();

        try {
            $penduduk = Penduduk::where('nik', $req['nik_kepala'])->first();
            $keluarga = Keluarga::create([
                'no_kk' => $req['no_kk'],
                'nik_kepala' => $req['nik_kepala'],
                'tgl_daftar' => date('Y-m-d H:i:s'),
                'id_cluster' => $penduduk->dusun_id,
                'lat' => $req['lat'],
                'lng' => $req['lng'],
            ]);

            $penduduk->update([
                'id_kk' => $keluarga->id
            ]);

            DB::commit();
            return redirect()->route('keluarga.index');
        } catch (\Exception $e) {
            DB::rollback();

            return back()
                ->withInput()
                ->with('error', "Error on file {$e->getFile()} line {$e->getLine()}: {$e->getMessage()}");
        } catch (\Throwable $e) {
            DB::rollback();

            return back()
                ->withInput()
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
        //
        $data['page_title'] = "Daftar Anggota Keluarga";
        $data['hubungan'] = PendudukHubungan::get();
        $data['desa'] = Desa::find(auth()->user()->desa_id);
        $data['kades'] = DesaPamong::where('is_kades',1)->first();

        $data['keluarga'] = Keluarga::orderBy('id', 'ASC')
            ->with([
                'kepalaKeluarga',
                'dusun',
                'penduduk' => function ($penduduk) {
                    $penduduk->with([
                        'agama',
                        'pendidikanKK',
                        'pekerjaan',
                        'status_kawin',
                        'kewarganegaraan'
                    ])->orderBy('kk_level', 'ASC')->orderBy('tanggallahir', 'ASC');
                }
            ])
            ->where('id', $id)->first();
        return view('keluarga.salinan', $data);
    }

    public function toJson($id)
    {
        $data = Keluarga::find($id);
        return response()->json($data);
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

        $data['keluarga'] = Keluarga::find($id);
        $data['page_title'] = "Edit Kartu Keluarga " . $data['keluarga']->no_kk;

        $data['keluargaSejahtera'] = KeluargaSejahtera::get();
        $data['bantuan'] = Program::get();
        //List Data for Keluarga
        $data['pendudukTanpaKK'] = Penduduk::where('id_kk', 0)->get();
        $data['listDusun'] = Wilayah::get();

        return view('keluarga.edit', $data);
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
        $req = $request->all();

        $keluarga = Keluarga::find($id);
        if (!$keluarga)
            abort(404);

        DB::rollback();
        DB::beginTransaction();

        try {
            $keluarga = new Keluarga();
            $fillable = $keluarga->getFillable();
            $data = Keluarga::where('id', $id)->update($request->only($fillable));

            ProgramPeserta::where('peserta', $id)->where('sasaran', 2)->delete();
            $arr = [];
            if (isset($request->program_id)) {

                foreach ($request->program_id as $key => $value) {
                    $dt = [
                        'sasaran' => 2,
                        'peserta' => $id,
                        'program_id' => $value,

                    ];
                    array_push($arr, $dt);
                }
                ProgramPeserta::insert($arr);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json($e->getMessage() . " at line " . $e->getLine());
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json($e->getMessage() . " at line " . $e->getLine());
        }

        return redirect()->route('keluarga.index');
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
        $keluarga = Keluarga::find($id);
        if (!$keluarga)
            return response()->json('data not found');

        DB::beginTransaction();
        try {

            Penduduk::where('id_kk', $id)->update([
                'id_kk' => 0
            ]);

            $keluarga->delete();



            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json($e->getMessage() . " at line " . $e->getLine());
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json($e->getMessage() . " at line " . $e->getLine());
        }
        return response()->json('data succesfully deleted');
    }
}
