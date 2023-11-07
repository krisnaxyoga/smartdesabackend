<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pengaduan;
use App\PengaduanComment;
use App\KepalaDusun;
use App\DesaPamong;
use DB;
use Validator;
class PengaduanController extends BaseApiController
{
    public function index(Request $request)
    {
        $desa_id = $request->header('DesaID');
        $data = Pengaduan::where('pengaduans.desa_id', $desa_id)
                            ->join('penduduk','penduduk.id', '=','pengaduans.penduduk_id')
                            ->select('pengaduans.*','penduduk.nama as pelapor')
                            ->with('category')
                            ->orderBy('created_at', 'DESC');
        if (isset($request->pengaduan_category_id)) {
            $data = $data->where('pengaduan_category_id', $request->pengaduan_category_id);
        }
        if (isset($request->search)) {
            $data = $data->where('title', 'like', '%' . $request->search . '%');
        }

        foreach ($data as $key => $value) {
            $data[$key]->content = substr((strip_tags($data[$key]->content)), 0, 55) . "...";
        }

        $paging = 10;
        if (isset($request->paging)) {
            $paging = $request->paging;
        }
        $data = $data->paginate($paging);

        return $this->successResponse($data);

    }

    public function show(Request $request, $id) {

        $desa_id = $request->header('DesaID');
        $data = Pengaduan::where('desa_id', $desa_id)->with('category','pelapor')->find($id);
        return $this->successResponse($data);
    }


    public function targetDisposisi(Request $request) {

        $desa_id = $request->header('DesaId');

        $data['data_staff_desa'] = DesaPamong::where('desa_id',$desa_id)->select('desa_pamong.id','desa_pamong.pamong_nama as nama','desa_pamong.jabatan')->get();
        $data['data_kadus'] = KepalaDusun::where('wilayah.desa_id',$desa_id)->select('kepala_dusun.id','kepala_dusun.dusun_id','kepala_dusun.name as nama','wilayah.dusun')->join('wilayah', 'wilayah.id','=','kepala_dusun.dusun_id')->get();
        return $this->successResponse($data);
    }

    public function updateDisposisi(Request $request, $id) {
        $data = Pengaduan::find($id);

        $desa_id = $request->header('DesaId');

        $validation = Validator::make($request->all(), [
            'user_type' => 'required',
            'user_id' => 'required',
            'content' => 'required',
        ]);
        if ($validation->fails()) {
            $msg = $this->getValidationErrorMessage($validation);
            return $this->errorResponse($msg);
        }

        $data->update([
            'user_target' => $request->user_type,
            'user_id' => $request->user_id,
            'status' => 'ON PROGRESS'
        ]);

        PengaduanComment::create([
                'desa_id' => $desa_id,
                'pengaduan_id' => $id,
                'user_type' => $request->user_type,
                'user_id' =>  $request->user_id,
                'content' => $request->content
        ]);
        return $this->successResponse($data);
    }

    // public function updateDisposisi(Request $request, $id) {
    //     $data = Pengaduan::find($id);

    //     $desa_id = $request->header('DesaId');

    //     $validation = Validator::make($request->all(), [
    //         'target_disposisi' => 'required',
    //         'content' => 'required',
    //     ]);
    //     if ($validation->fails()) {
    //         $msg = $this->getValidationErrorMessage($validation);
    //         return $this->errorResponse($msg);
    //     }

    //     $target = $request->target_disposisi;

    //     $check_staff = DesaPamong::where([
    //         'jabatan' => $target,
    //         'desa_id' => $desa_id
    //     ])->first();

    //     if ($check_staff != null) {

    //         $data->update([
    //                 'user_target' => 'DESA',
    //                 'user_id' => $check_staff->id,
    //                 'status' => 'ON PROGRESS'
    //         ]);

    //         PengaduanComment::create([
    //             'pengaduan_id' => $id,
    //             'user_type' => "KADUS",
    //             'user_id' => $check_staff->id,
    //             'content' => $request->content
    //         ]);
    //     } else {

    //         $check_kadus = KepalaDusun::select('kepala_dusun.id','kepala_dusun.dusun_id','kepala_dusun.name as nama','wilayah.dusun')
    //                                         ->where([
    //                                             'wilayah.desa_id' => $desa_id,
    //                                             'wilayah.dusun' => $target
    //                                         ])
    //                                         ->join('wilayah', 'wilayah.id','=','kepala_dusun.dusun_id')
    //                                         ->first();

    //         $data->update([
    //                 'user_target' => 'KADUS',
    //                 'user_id' => $check_kadus->id,
    //                 'status' => 'ON PROGRESS'
    //         ]);

    //         PengaduanComment::create([
    //             'pengaduan_id' => $id,
    //             'user_type' => "KADUS",
    //             'user_id' => $check_kadus->id,
    //             'content' => $request->content
    //         ]);
    //     }



    //     return $this->successResponse($data);
    // }


}
