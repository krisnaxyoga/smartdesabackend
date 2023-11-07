<?php

namespace App\Http\Controllers;

use App\Desa;
use App\DesaPamong;
use App\Exports\SuratExport;
use App\JenisSurat;
use App\Notification as LogNotification;
use App\Penduduk;
use App\PengajuanSurat;
use App\SuratAnggota;
use App\Utils\Notification;
use App\Wilayah;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class SuratController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = JenisSurat::orderBy('kode_surat', 'ASC')->get();
        return view('surat.index', [
            'data' => $data,
            'page_title' => "Cetak Surat"
        ]);
    }

    public function indexRequest(Request $request)
    {
        if (isset($request->type)) {
            if ($request->type == 'datatable') {
                $data = PengajuanSurat::orderBy('pengajuan_surat.created_at', 'DESC')
                    ->select('pengajuan_surat.id', 'pengajuan_surat.is_mobile', 'pengajuan_surat.track_number', 'penduduk.nama as penduduk_nama', 'pengajuan_surat.keperluan', 'jenis_surat.judul as judul', 'wilayah.dusun as nama_dusun', 'pengajuan_surat.status', 'pengajuan_surat.created_at', 'pengajuan_surat.tanggal_pengajuan', 'pengajuan_surat.tanggal_verifikasi', 'pengajuan_surat.tanggal_cetak')
                    ->join('penduduk', 'penduduk.id', '=', 'pengajuan_surat.penduduk_id')
                    ->join('wilayah', 'wilayah.id', '=', 'pengajuan_surat.dusun_id')
                    ->join('jenis_surat', 'jenis_surat.id', '=', 'pengajuan_surat.jenis_surat_id')
                    ->where('pengajuan_surat.is_mobile', '=', '1')
                    ->get();

                return datatables()->of($data)
                    ->addColumn('action', function ($data) {
                        $detail = "<a href='" . route('surat.detail', [$data->id]) . "' class='btn btn-primary btn-sm text-center' style='display : inline-block'><i class='fa fa-eye'></i></a>";
                        // return '<div class="btn-group"><button type="button" class="btn btn-rounded btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-gear"></i> Action <span class="caret"></span></button><ul class="dropdown-menu"><li><a href="' . route('suku.edit', $data->id) . '">Edit</a><li><a data-id="' . $data->id . '" data-label="suku" data-url="/suku/' . $data->id . '" class="delete-item text-danger">Delete</a></ul></div>';
                        if ($data->status == "ACCEPTED") {
                            $detail .= " <a href='" . route('surat.permohonan.cetak', [$data->id]) . "' class='btn btn-success btn-sm text-center' style='display : inline-block'><i class='fa fa-print'></i></a>";
                        }
                        $detail .= ' <a data-id="' . $data->id . '" data-label="surat" data-url="' . route('surat.destroy', $data->id) . '" class="delete-item btn btn-danger btn-sm text-center"><i class="fa fa-trash" style="color:white"></i></a>';
                        return $detail;
                    })
                    ->editColumn('tanggal_pengajuan', function ($data) {
                        if ($data->is_mobile) {
                            $tanggal = $data->konversiTgl($data->tanggal_pengajuan);
                        } else {
                            $tanggal = $data->konversiTgl($data->tanggal_cetak);
                        }
                        return $tanggal;
                    })
                    ->editColumn('tanggal_verifikasi', function ($data) {
                        if ($data->status == "REQUESTED") {
                            // $tanggal = $data->konversiTgl($data->tanggal_pengajuan);
                            $tanggal = "-";
                        } else {
                            $tanggal = $data->konversiTgl($data->tanggal_verifikasi);
                        }
                        return $tanggal;
                    })
                    ->editColumn('tanggal_cetak', function ($data) {
                        if ($data->status == "REQUESTED" || $data->status != "GENERATED") {
                            // $tanggal = $data->konversiTgl($data->tanggal_pengajuan);
                            $tanggal = "-";
                        } else {
                            $tanggal = $data->konversiTgl($data->tanggal_cetak);
                        }
                        return $tanggal;
                    })
                    ->editColumn('status', function ($data) {
                        switch ($data->status) {
                            case 'REQUESTED':
                                $status = "<span class='text-warning'>SEDANG DIAJUKAN</span>";
                                break;
                            case 'ACCEPTED':
                                $status = "<span class='text-primary'>VERIFIKASI DATA</span>";
                                break;
                            case 'GENERATED':
                                $status = "<span class='text-success'>SUDAH DICETAK</span>";
                                break;
                            case 'REJECTED':
                                $status = "<span class='text-danger'>DITOLAK KEPALA DUSUN</span>";
                                break;
                            default:
                                $status = "<span class='text-info'>$data->status</span>";

                                break;
                        }

                        return $status;
                    })
                    ->rawColumns(['action', 'status'])
                    ->make(true);
            }
        }
        return view('surat.permohonan.index', [
            'page_title' => "Daftar Permohonan Surat"
        ]);
    }

    public function arsip(Request $request)
    {
        if (isset($request->type)) {
            if ($request->type == 'datatable') {
                $data = PengajuanSurat::orderBy('pengajuan_surat.created_at', 'DESC')
                    ->select('pengajuan_surat.id', 'pengajuan_surat.nomor_surat', 'penduduk.nama as penduduk_nama', 'pengajuan_surat.keperluan', 'pengajuan_surat.jenis_surat_id', 'jenis_surat.judul as judul', 'wilayah.dusun as nama_dusun', 'pengajuan_surat.status', 'pengajuan_surat.created_at')
                    ->join('penduduk', 'penduduk.id', '=', 'pengajuan_surat.penduduk_id')
                    ->join('wilayah', 'wilayah.id', '=', 'pengajuan_surat.dusun_id')
                    ->join('jenis_surat', 'jenis_surat.id', '=', 'pengajuan_surat.jenis_surat_id')
                    ->where('pengajuan_surat.status', '=', 'GENERATED')
                    ->get();

                return datatables()->of($data)
                    ->addColumn('action', function ($data) {
                        $detail = "<a href='" . route('surat.detail', [$data->id]) . "' class='btn btn-primary btn-sm text-center' style='display : inline-block'><i class='fa fa-eye'></i></a>";
                        // return '<div class="btn-group"><button type="button" class="btn btn-rounded btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-gear"></i> Action <span class="caret"></span></button><ul class="dropdown-menu"><li><a href="' . route('suku.edit', $data->id) . '">Edit</a><li><a data-id="' . $data->id . '" data-label="suku" data-url="/suku/' . $data->id . '" class="delete-item text-danger">Delete</a></ul></div>';
                        $detail .= " <a href='" . route('render.surat', [$data->jenis_surat_id, $data->id]) . "' target='_blank' class='btn btn-success btn-sm text-center' style='display : inline-block'><i class='fa fa-print'></i></a>";
                        $detail .= ' <a href="#" data-id="' . $data->id . '" data-label="surat" data-url="' . route('surat.destroy', $data->id) . '" class="delete-item btn btn-danger btn-sm text-center"><i class="fa fa-trash"></i></a>';
                        return $detail;
                    })
                    ->editColumn('status', function ($data) {
                        switch ($data->status) {
                            case 'REQUESTED':
                                $status = "<span class='text-warning'>SEDANG DIAJUKAN</span>";
                                break;
                            case 'ACCEPTED':
                                $status = "<span class='text-primary'>DISETUJUI KEPALA DUSUN</span>";
                                break;
                            case 'GENERATED':
                                $status = "<span class='text-success'>SUDAH DICETAK</span>";
                                break;
                            case 'REJECTED':
                                $status = "<span class='text-danger'>DITOLAK KEPALA DUSUN</span>";
                                break;
                            default:
                                $status = "<span class='text-info'>$data->status</span>";

                                break;
                        }

                        return $status;
                    })
                    ->rawColumns(['action', 'status'])
                    ->make(true);
            }
        }
        return view('surat.arsip.index', [
            'page_title' => "Daftar Surat "
        ]);
    }

    public function create($id)
    {
        $jenisSurat = JenisSurat::find($id);
        $pamong = DesaPamong::get();
        return view('surat.create', [
            'jenis_surat' => $jenisSurat,
            'page_title' => "Cetak " . $jenisSurat->judul,
            'staff' => $pamong
        ]);
    }

    public function createRequest($id)
    {
        $surat = PengajuanSurat::find($id);
        $pamong = DesaPamong::get();
        $penduduk = Penduduk::where('id', $surat->penduduk_id)
            ->with('agama', 'pendidikanKK', 'pekerjaan', 'dusun', 'kewarganegaraan')
            ->first();
        return view('surat.permohonan.create', [
            'surat' => $surat,
            'penduduk' => $penduduk,
            'page_title' => "Cetak " . $surat->jenisSurat->judul,
            'staff' => $pamong
        ]);
    }

    public function show($id)
    {
        $data = PengajuanSurat::find($id);
        return view('surat.detail', [
            "page_title" => "Detail " . $data->nomor_surat,
            "data" => $data
        ]);
    }

    public function destroy($id)
    {
        $data = PengajuanSurat::find($id);

        if ($data !== null) {
            $data->delete();

            return [
                'error' => false,
                'message' => 'Surat berhasil dihapus.'
            ];
        }

        return response()->json([
            'error' => true,
            'message' => 'Surat tidak ditemukan.'
        ], 404);
    }

    public function store(Request $request, $code)
    {
        // dd($request);

        // return response()->json($request->all());
        $penduduk = Penduduk::find($request->penduduk_id);
        $code = JenisSurat::find($code);
        $form = new PengajuanSurat();
        $request->request->add(
            [
                "staff_sebagai_id" => $penduduk->staff_id,
                "dusun_id" => $penduduk->dusun_id,
                "jenis_surat_id" => $code->id,
                "status" => "GENERATED"
            ]
        );
        $surat = PengajuanSurat::create($request->only($form->getFillable()));
        if ($request->has('anggota_id') && count($request->anggota_id) > 0) {
            for ($i = 0; $i < count($request->anggota_id); $i++) {
                $pdd = Penduduk::find($request->anggota_id[$i]);
                $anggota = [
                    'penduduk_id' => $pdd->id,
                    'nama' => $pdd->nama,
                    'jenis_kelamin' => $pdd->sex,
                    'umur' => $pdd->umur,
                    'status' => $pdd->status_kawin->nama,
                    'pendidikan' => $pdd->pendidikanKK->nama,
                    'ktp' => $pdd->nik,
                    'pengajuan_surat_id' => $surat->id,
                    'keterangan' => isset($request->ket[$i]) ? $request->ket[$i] : '',
                ];
                SuratAnggota::create($anggota);
            }
        }

        if ($surat) {
            return redirect()->route('surat.detail', [$surat->id]);
        } else {
            return redirect()->back()->withErrors(["Error save data"]);
        }

        // $data = [
        //     "data" => $penduduk,
        //     "request" => $request,
        //     "staff" => DesaPamong::find($request->staff_desa),
        //     "staffPosisi" => DesaPamong::find($request->staff_desa_posisi),

        //     "jenisSurat" => $code
        // ];

    }

    public function update(Request $request, $id)
    {

        // return response()->json($request->all());
        $surat = PengajuanSurat::find($id);
        $penduduk = Penduduk::find($surat->penduduk_id);
        $code = JenisSurat::find($surat->jenis_surat_id);
        $form = new PengajuanSurat();

        $request->request->add(
            [
                "dusun_id" => $penduduk->dusun_id,
                "jenis_surat_id" => $code->id,
                "status" => "GENERATED"
            ]
        );

        $surat->update($request->only($form->getFillable()));

        foreach ($penduduk->devices as $key => $value) {
            Notification::send([
                'title' => 'Surat Telah Dicetak',
                'body' => 'Permohonan ' . $surat->jenisSurat->judul . ' anda telah dicetak pada ' . date('Y-m-d'),
                'to' => $value->device_id,
                'click_action' => 'PENDUDUK_SURAT'
            ]);

            LogNotification::create([
                'description' => 'Permohonan ' . $surat->jenisSurat->judul . ' oleh ' . $penduduk->nama . ' pada dusun ' . $surat->dusun->dusun . ' telah dicetak pada ' . $surat->konversiTgl(date('Y-m-d')),
                'ref_id' => $surat->id,
                'ref_type' => "PERMOHONAN_SURAT"
            ]);
        }


        if ($surat) {
            return redirect()->route('render.surat', [$code->id, $surat->id]);
        } else {
            return redirect()->back()->withErrors(["Error save data"]);
        }

        // $data = [
        //     "data" => $penduduk,
        //     "request" => $request,
        //     "staff" => DesaPamong::find($request->staff_desa),
        //     "staffPosisi" => DesaPamong::find($request->staff_desa_posisi),

        //     "jenisSurat" => $code
        // ];

    }

    public function tampilSurat($jenis, $id)
    {
        $code = JenisSurat::find($jenis);

        $desa_id = auth()->user()->desa_id;
        $desa = Desa::find($desa_id);
        $surat = PengajuanSurat::find($id);
        
        $data = [
            'data' => $surat,
            'desa' => $desa
        ];
        $pdf = PDF::loadView('surat.' . $code->kode_surat, $data);
        return $pdf->stream($surat->jenisSurat->judul . ' - ' . $surat->nomor_surat . '.pdf');
        // return view('surat.SKTM',$data);
    }

    public function recap(Request $request)
    {
        $dusun = Wilayah::get();
        return view('surat.laporan.index', [
            'dusun' => $dusun
        ]);
    }

    public function recapPreview(Request $request)
    {
        $dusun = Wilayah::find($request->dusun_id);
        $data = PengajuanSurat::select('*')
            ->where('dusun_id', $request->dusun_id)
            ->whereBetween('tanggal_cetak', [$request->start_date, $request->end_date])
            ->orderBy('created_at', 'ASC')
            ->get();

        $values = [
            'data' => $data,
            'dusun' => $dusun,
            'request' => $request
        ];

        if ($request->filled('output')) {
            if ($request->output == 'pdf') {
                $pdf = PDF::loadView('surat.laporan.preview', $values)
                    ->setPaper('a4', 'landscape')
                    ->setOptions([
                        'defaultMediaType' => 'print'
                    ]);

                return $pdf->stream("Rekapitulasi Surat - {$dusun->dusun}.pdf");
            } elseif ($request->output == 'xls') {
                return Excel::download(new SuratExport($request), "Rekapitulasi Surat - {$dusun->dusun}.xls");
            }
        }

        return view('surat.laporan.preview', $values);
    }
}
