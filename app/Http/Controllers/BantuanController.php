<?php

namespace App\Http\Controllers;

use App\AnalisisRefSubjek;
use App\Penduduk;

use App\Program;

use App\ProgramPeserta;
use Auth, DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BantuanController extends Controller
{
    /**
     * Controller construction.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Index page.
     * 
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        $data['page_title'] = "Bantuan";
        if ($request->type == 'datatable') {
            $bantuans = Program::select('program.*', 'analisis_ref_subjek.subjek')
                ->leftJoin('analisis_ref_subjek', 'analisis_ref_subjek.id', '=', 'program.sasaran')
                ->orderBy('nama', 'ASC')
                ->get();

            return datatables()->of($bantuans)
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group">
                                <button type="button" class="btn btn-rounded btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-gear"></i> Action <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a target="_blank" href="' . route('bantuan.edit', $data->id) . '">Edit</a></li>
                                    <li><a data-id="' . $data->id . '" data-label="bantuan" data-url="/bantuan/' . $data->id . '" class="delete-item text-danger">Delete</a></li>
                                </ul>
                            </div>';
                })
                ->addColumn('valid', function ($data) {
                    return $this->convertDate($data->sdate) . ' s/d ' . $this->convertDate($data->edate);
                })
                ->editColumn('nama', function ($data) {
                    return "<a href='" . route('bantuan.show', $data->id) . "' class='link'>" . $data->nama . "</a>";
                })
                ->rawColumns(['action', 'valid', 'nama'])
                ->make(true);
        } else if ($request->type == 'json') {
            $bantuans = Program::orderBy('dusun', 'ASC');

            if ($request->keyword) {
                $bantuans = $bantuans->where(
                    'dusun',
                    'LIKE',
                    DB::raw('"%' . $request->keyword . '%"')
                );
            }

            $bantuans = $bantuans::get();

            return response()->json($bantuans);
        } else {
            return view('bantuan.index', $data);
        }
    }

    public function convertDate($date)
    {
        return date("d M Y", strtotime($date));
    }

    /**
     * Create page.
     * 
     * @param  Request  $request
     * @return Response
     */
    public function create(Request $request)
    {
        $data['page_title'] = "Tambah Bantuan";
        $data['sasaran'] = AnalisisRefSubjek::orderBy('subjek')->get();
        return view('bantuan.create', $data);
    }

    public function show($id)
    {
        $detail = Program::where('id', $id)
            ->with([
                'analisisRefSubjek',
                'peserta' => function ($peserta) {
                    $peserta->with(['keluarga' => function ($keluarga) {
                        $keluarga->with('kepalaKeluarga');
                    }, 'penduduk'])->where(function($e){
                        $e->whereHas('penduduk')->orWhereHas('keluarga');
                    });
                }
            ])
            ->first();
        $data['page_title'] = "Detail Bantuan " . $detail->name;
        $data['data'] = $detail;
        return view('bantuan.detail', $data);
    }

    /**
     * Edit page.
     * 
     * @param  Request  $request
     * @param  String   $id
     * @return Response
     */
    public function edit(Request $request, $id)
    {
        $data = Program::find($id);
        return view('bantuan.edit', [
            'data' => $data,
            'sasaran' => AnalisisRefSubjek::orderBy('subjek')->get(),
            'page_title' => "Edit Bantuan : {$data->dusun}"
        ]);
    }

    /**
     * Store resource.
     * 
     * @param  Request  $request
     * @param  String   $id
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|max:255'
        ]);

        Program::create([
            'nama' => $request->nama,
            'ndesc' => $request->ndesc,
            'sdate' => $request->sdate,
            'edate' => $request->edate,
            'sasaran' => $request->sasaran,
        ]);

        if (isset($_POST['savenew'])) {
            return redirect()->back()->with('success', 'Bantuan successfully added.');
        } else {
            return redirect('bantuan');
        }
    }

    /**
     * Store resource.
     * 
     * @param  Request  $request
     * @param  String   $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required|max:255'
        ]);

        Program::find($id)->update([
            'nama' => $request->nama,
            'ndesc' => $request->ndesc,
            'sdate' => $request->sdate,
            'edate' => $request->edate,
            'sasaran' => $request->sasaran,
        ]);

        return redirect('bantuan')->with('success', 'Bantuan successfully updated.');
    }

    /**
     * Delete resource.
     * 
     * @param  Request  $request
     * @param  String   $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        try {
            Program::find($id)->delete();

            if ($request->ajax()) {
                return response()->json([
                    'error' => false,
                    'message' => 'Bantuan successfully deleted.'
                ]);
            }

            return redirect()->back()->with('success', 'Bantuan successfully deleted.');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'error' => false,
                    'message' => 'Bantuan failed to delete.'
                ]);
            }

            return redirect()->back()->with('error', 'Bantuan failed to delete.');
        }
    }

    public function tambahPeserta($id)
    {
        $bantuan = Program::findOrFail($id);

        $data['data'] = $bantuan;

        $data['page_title'] = "Tambah Peserta " . $bantuan->name;



        return view('bantuan.peserta.create', $data);
    }

    public function editPeserta($id, $peserta)
    {
        $bantuan = Program::findOrFail($id);
        $peserta = ProgramPeserta::findOrFail($peserta);

        $data['page_title'] = "Edit Peserta " . $peserta->name;
        $data['data'] = $bantuan;


        $data['peserta'] = $peserta;


        return view('bantuan.peserta.edit', $data);
    }

    public function dataPeserta(Request $request, $bantuan)
    {
        $NIKList = ProgramPeserta::select('peserta')->whereNotNull('peserta')->where('sasaran', 1)->where('id', $bantuan)->pluck('peserta')->all();

        $data['pendudukList'] = Penduduk::whereNotIn('nik', $NIKList)->with('dusun', 'agama', 'pendidikanKK', 'kewarganegaraan')->where('nama', 'like', "%" . $request->search . "%")->get();


        return response()->json($data['pendudukList']);
    }

    public function hapusPeserta(Request $request, $id, $peserta)
    {
        ProgramPeserta::where('id', $peserta)->delete();

        return response()->json([
            'error' => false
        ]);
    }

    public function storePeserta(Request $request, $id)
    {
        // return response()->json($request->all());

        $bantuan = Program::findOrFail($id);

        $penduduk = Penduduk::findOrFail($request->peserta_id);

        $arr = [
            'peserta' => $penduduk->id,
            'program_id' => $id,
            'sasaran' => 1,
            'no_id_kartu' => $request->no_id_kartu,
            'kartu_nik' => $request->kartu_nik,
            'kartu_nama' => $request->kartu_nama,
            'kartu_tempat_lahir' => $request->kartu_tempat_lahir,
            'kartu_tanggal_lahir' => $request->kartu_tanggal_lahir,
            'kartu_alamat' => $request->kartu_alamat,
            'kartu_peserta' => null,
        ];

        try {
            if ($request->file('profile') !== null) {
                $url = $this->uploadFileToS3($request);
                // dd($url);
                $arr['kartu_peserta'] = $url;
            }
            ProgramPeserta::create($arr);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Error BantuanController : ' . $e->getMessage() . ' at line ' . $e->getLine()
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Error BantuanController : ' . $e->getMessage() . ' at line ' . $e->getLine()
            ]);
        }

        return redirect()->route('bantuan.show', [$id]);
    }

    public function updatePeserta(Request $request, $id, $peserta)
    {
        // return response()->json($request->all());

        $bantuan = Program::findOrFail($id);
        $programPeserta = ProgramPeserta::findOrFail($peserta);

        $penduduk = Penduduk::findOrFail($request->peserta_id);

        $arr = [
            'peserta' => $penduduk->id,
            'program_id' => $id,
            'sasaran' => 1,
            'no_id_kartu' => $request->no_id_kartu,
            'kartu_nik' => $request->kartu_nik,
            'kartu_nama' => $request->kartu_nama,
            'kartu_tempat_lahir' => $request->kartu_tempat_lahir,
            'kartu_tanggal_lahir' => $request->kartu_tanggal_lahir,
            'kartu_alamat' => $request->kartu_alamat,
            'kartu_peserta' => null,
        ];

        try {
            if ($request->file('profile') !== null) {
                $url = $this->uploadFileToS3($request);
                // dd($url);
                $arr['kartu_peserta'] = $url;
            }
            ProgramPeserta::where('id', $peserta)->update($arr);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([$e->getMessage() . " at line " . $e->getLine()]);
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors([$e->getMessage() . " at line " . $e->getLine()]);
        }

        return redirect()->route('bantuan.show', [$id]);
    }

    public function uploadFileToS3($request)
    {
        $image = $request->file('profile');

        // Generate streamed file.

        $imageFileName = md5(time()) . md5($image->getClientOriginalName());
        // $image = Image::make($request->file('logo'))->resize(300, null, function ($constraint) {
        //     $constraint->aspectRatio();
        // })->stream();
        // dd((string)$image);
        $s3 = \Storage::disk('s3');
        $imageFileName = $s3->putFile('penduduk', $image, 'public');

        $publicURI = "https://" . env('AWS_URL') . "/" . env('AWS_BUCKET') . "/" . $imageFileName;
        return $publicURI;
    }
}
