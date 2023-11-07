<?php

namespace App\Http\Controllers;

use App\DesaPamong;
use App\KepalaDusun;
use Illuminate\Http\Request;
use App\Pengaduan;
use App\PengaduanCategories;
use App\Penduduk;
use App\PengaduanComment;
use DB;
use App\Device;
use App\Utils\Notification;
use App\Notification as LogNotification;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['page_title'] = "Data Pengaduan";
        $data['list_kategori'] = PengaduanCategories::where('desa_id', auth()->user()->desa_id)->get();

        if ($request->type == 'datatable') {

            $pengaduan = Pengaduan::select('pengaduans.*','penduduk.nama as pelapor','pengaduan_categories.name as category')
                                ->where('pengaduans.desa_id', auth()->user()->desa_id)
                                ->join('penduduk','penduduk.id', '=', 'pengaduans.penduduk_id')
                                ->join('pengaduan_categories','pengaduan_categories.id', '=', 'pengaduans.pengaduan_category_id')
                                ->orderBy('created_at','DESC');

            return datatables()->of($pengaduan)

                ->filter(function ($query) use ($request) {
                    if (
                        $request->has('start_date') &&
                        $request->start_date !== null &&
                        $request->start_date !== ''
                    ) {
                        $start_date = date('Y-m-d',strtotime($request->start_date));
                        $query->where('start_date', $start_date);
                    }
                    if (
                        $request->has('end_date') &&
                        $request->end_date !== null &&
                        $request->end_date !== ''
                    ) {
                        $end_date = date('Y-m-d',strtotime($request->end_date));
                        $query->where('end_date', '=', $end_date);
                    }
                    if (
                        $request->has('pengaduan_category_id') &&
                        $request->pengaduan_category_id !== null &&
                        $request->pengaduan_category_id !== ''
                    ) {
                        $query->where('pengaduan_category_id', $request->pengaduan_category_id);
                    }
                    if (
                        $request->has('search_by') &&
                        $request->has('keyword') &&
                        $request->search_by !== null &&
                        $request->keyword !== null &&
                        $request->search_by !== '' &&
                        $request->keyword !== ''
                    ) {
                        $query->where($request->search_by, 'LIKE', "%{$request->keyword}%");
                    }
                })
                ->addColumn('action', function ($data) {
                    if ($data->user_target == null ) {
                        $disposisi =  '<a href="'.route('pengaduan.edit-disposisi', $data->id).'" class="m-1 btn btn-primary text-white"><i class="fa fa-mail-forward"></i></a>';
                    } else {
                        $disposisi = '';
                    }
                    if ($data->status == "PUBLISH" || $data->status == "ON PROGRESS") {
                        $tandai = '<a data-id="' . $data->id . '" data-label="pengaduan" data-url="/tandai-selesai/' . $data->id . '" class="m-1 btn btn-success mark-done-item text-white"><i class="fa fa-check"></i></a>';
                    } else {
                        $tandai = '';
                    }
                    $delete = '<a data-id="' . $data->id . '" data-label="pengaduan" data-url="/pengaduan/' . $data->id . '" class="m-1 btn btn-danger delete-item text-white"><i class="fa fa-trash"></i></a>';

                    return  $disposisi.$tandai.$delete;
                })
                ->editColumn('title', function ($data) {
                    return '<a href="'.route('pengaduan.show', $data->id).'" class="text-primary">'.$data->title.'</a>';
                })
                ->editColumn('status', function ($data) {

                    if ($data->status == "PUBLISH") {
                        return '<div class="badge badge-pill blue"><p class="m-2 text-white">'.$data->status.'</p></div>';
                    } elseif ($data->status == "ON PROGRESS") {
                        return '<div class="badge badge-pill orange"><p class="m-2 text-white">'.$data->status.'</p></div>';
                    } elseif ($data->status == "DONE") {
                        return '<div class="badge badge-pill success"><p class="m-2 text-white">'.$data->status.'</p></div>';
                    } elseif ($data->status == "NOSHOW") {
                        return '<div class=" badge badge-pill dark"><p class="m-2 text-white">'.$data->status.'</p></div>';
                    }
                })
                ->rawColumns(['action','title','status'])
                ->make(true);
        } else {
            return view('pengaduan.index', $data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $desa_id = auth()->user()->desa_id;
        $data['page_title'] = "Detail Pengaduan";
        $data['pengaduan'] = Pengaduan::with('pelapor','category')->where('id', $id)->first();
        $data['list_tindakan'] = PengaduanComment::where([
            ['pengaduan_id', $id],
            ['pengaduan_comments.desa_id', $desa_id]
        ])->orderBy('created_at', 'ASC')->get();
        // $data['list_comment'] = PengaduanComment::select('pengaduan_comments.*', 'penduduk.nama as nama_penduduk')
        //                         ->join('penduduk', 'penduduk.id', '=', 'pengaduan_comments.user_id')
        //                         ->where([
        //                                     ['pengaduan_id', $id],
        //                                     ['user_type', '=', 'PENDUDUK'],
        //                                     ['pengaduan_comments.desa_id', $desa_id]
        //                                 ])
        //                         ->orderBy('created_at','ASC')
        //                         ->get();
        //return response()->json($data);
        return view('pengaduan.detail', $data);
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

    }

    public function editDisposisi($id)
    {
        $data['page_title'] = "Disposisi Pengaduan";

        $data['pendaduan'] = Pengaduan::find($id);

        $desa_id = auth()->user()->desa_id;

        $data['data_staff_desa'] = DesaPamong::where('desa_id',$desa_id)->select('desa_pamong.id','desa_pamong.pamong_nama as nama','desa_pamong.jabatan')->get();
        $data['data_kadus'] = KepalaDusun::select('kepala_dusun.*', 'wilayah.dusun as dusun')->where('wilayah.desa_id',$desa_id)->join('wilayah', 'wilayah.id','=','kepala_dusun.dusun_id')->get();
        return view('pengaduan.disposisi', $data);
    }

    public function disposisi(Request $request, $id) {
        $data = Pengaduan::find($id);

        $desa_id = auth()->user()->desa_id;
        $target = $request->target_disposisi;

        $check_staff = DesaPamong::where([
            'jabatan' => $target,
            'desa_id' => $desa_id
        ])->first();

        try {

            if ($check_staff != null) {

                $data->update([
                    'user_target' => 'DESA',
                    'user_id' => $check_staff->id,
                    'status' => 'ON PROGRESS'
                ]);

                $device_staff = Device::join('desa_pamong', 'devices.staff_id', '=', 'desa_pamong.id')
                                        ->where('desa_pamong.id', $data->user_id)
                                        ->select('devices.*')->first();
                $device_penduduk = Device::join('penduduk', 'devices.penduduk_id', '=', 'penduduk.id')
                                        ->where('penduduk.id', $data->penduduk_id)
                                        ->select('devices.*')->first();

                if ($device_staff != null) {
                    $devices = [$device_staff, $device_penduduk];

                    foreach ($devices as $key => $value) {
                        Notification::send([
                            'title' => 'Disposisi Pengaduan',
                            'body' => 'Pengaduan didisposisi ke ' . $check_staff->nama . ' ' . $check_staff->jabatan,
                            'to' => $value->device_id,
                            'click_action' => ''
                        ]);
                    }
                }


            } else {

                $check_kadus = KepalaDusun::select('kepala_dusun.id','kepala_dusun.dusun_id','kepala_dusun.name as nama','wilayah.dusun')
                                            ->where([
                                                'wilayah.desa_id' => $desa_id,
                                                'wilayah.dusun' => $target
                                            ])
                                            ->join('wilayah', 'wilayah.id','=','kepala_dusun.dusun_id')
                                            ->first();

                $data->update([
                    'user_target' => 'KADUS',
                    'user_id' => $check_kadus->id,
                    'status' => 'ON PROGRESS'
                ]);

                $device_kadus = Device::join('kepala_dusun', 'devices.kadus_id', '=', 'kepala_dusun.id')
                                        ->where('kepala_dusun.id', $data->user_id)
                                        ->select('devices.*')->first();
                $device_penduduk = Device::join('penduduk', 'devices.penduduk_id', '=', 'penduduk.id')
                                        ->where('penduduk.id', $data->penduduk_id)
                                        ->select('devices.*')->first();

                if ($device_kadus != null) {
                    $devices = [$device_kadus, $device_penduduk];

                    foreach ($devices as $key => $value) {
                        Notification::send([
                            'title' => 'Disposisi Pengaduan',
                            'body' => 'Pengaduan didisposisi ke ' . $check_kadus->nama . ' Kepala ' . $check_kadus->dusun,
                            'to' => $value->device_id,
                            'click_action' => ''
                        ]);
                    }
                }

            }

            if ($request->content != null) {

                PengaduanComment::create([
                    'desa_id' =>  $desa_id,
                    'pengaduan_id' => $id,
                    'user_type' => "ADMIN",
                    'user_id' => auth()->user()->id,
                    'content' => $request->content
                ]);
            }

            return redirect()->route('pengaduan.index');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors([$th->getMessage() . " at line " . $th->getLine()]);
        }
    }

    public function markDone(Request $request, $id)
    {
        try {
            $data = Pengaduan::find($id);

            $data->update([
                'status' => 'DONE',
                'end_date' => date('Y-m-d')
            ]);


            // add notification
            $device_penduduk = Device::join('penduduk', 'devices.penduduk_id', '=', 'penduduk.id')
                                    ->where('penduduk.id', $data->penduduk_id)
                                    ->select('devices.*')->first();
            if ($data->user_target == 'DESA') {
                $device_staff = Device::join('desa_pamong', 'devices.staff_id', '=', 'desa_pamong.id')
                                    ->where('desa_pamong.id', $data->user_id)
                                    ->select('devices.*')->first();
                $devices = [$device_staff, $device_penduduk];
            } else {
                $device_kadus = Device::join('kepala_dusun', 'devices.kadus_id', '=', 'kepala_dusun.id')
                                    ->where('kepala_dusun.id', $data->user_id)
                                    ->select('devices.*')->first();
                $devices = [$device_kadus, $device_penduduk];
            }

            foreach ($devices as $key => $value) {
                Notification::send([
                    'title' => 'Pengaduan #'.$data->no_pengaduan,
                    'body' => 'Pengaduan #'.$data->no_pengaduan . ' ditandai selesai',
                    'to' => $value->device_id,
                    'click_action' => ''
                ]);
            }
            // end notification

            if ($request->ajax()) {
                return response()->json([
                    'error' =>false,
                    'message' => "Data Pengaduan successfully updated."
                ]);
            }
            return redirect()->back()->with('success', 'Data Pengaduan successfully updated.');
        } catch (\Exception $e) {

            if ($request->ajax()) {
                return response()->json([
                    'error' => false,
                    'message' => 'Data Pengaduan failed to updated.'
                ]);
            }
            return redirect()->back()->with('error', 'Data Pengaduan failed to updated.');
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
            $data = Pengaduan::find($id)->delete();
            PengaduanComment::where('pengaduan_id', $id)->delete();
            if ($request->ajax()) {
                return response()->json([
                    'error' =>false,
                    'message' => "Data Pengaduan successfully deleted."
                ]);
            }
            return redirect()->back()->with('success', 'Data Pengaduan successfully deleted.');
        } catch (\Exception $e) {

            if ($request->ajax()) {
                return response()->json([
                    'error' => false,
                    'message' => 'Data Pengaduan failed to delete.'
                ]);
            }

            return redirect()->back()->with('error', 'Data Pengaduan failed to delete.');
        }
    }
}
