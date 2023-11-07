<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pengaduan;
use App\PengaduanComment;
use App\KepalaDusun;
use App\DesaPamong;
use App\Wilayah;
use DB;
use App\Utils\Notification;
use App\Device;
class PengaduanCommentController extends BaseApiController
{

    public function commentPublics(Request $request, $id) {
        $desa_id = $request->header('DesaId');
        $data = PengaduanComment::select('pengaduan_comments.*', 'penduduk.nama as nama_penduduk')
                                ->join('penduduk', 'penduduk.id', '=', 'pengaduan_comments.user_id')
                                ->where([
                                            ['pengaduan_id', $id],
                                            ['user_type', '=', 'PENDUDUK'],
                                            ['pengaduan_comments.desa_id', $desa_id]
                                        ])
                                ->orderBy('created_at','ASC')
                                ->get();
        return $this->successResponse($data);
    }

    public function comment(Request $request, $id) {

        $desa_id = $request->header('DesaId');
        $data = PengaduanComment::where([
            ['pengaduan_id', $id],
            ['pengaduan_comments.desa_id', $desa_id]
        ])->orderBy('created_at', 'ASC')->get();

        return $this->successResponse($data);
    }

    //Reply Pengaduan by Staff Desa
    public function replyByStaff(Request $request, $pengaduan)
    {
        $key = $request->bearerToken();
        $desa_id = $request->header('DesaId');
        $staff = DesaPamong::where([['token', $key],['desa_id',$desa_id]])->first();

        if ($staff == null) {
            $msg = "Invalid Credentials";
            return $this->errorResponse($msg);
        }

        if ($request->file('photo') !== null) {
            $url = $this->uploadFileToS3($request);
        } else {
            $url = null;
        }

        $data = PengaduanComment::create([
            'desa_id' => $desa_id,
            'pengaduan_id' => $pengaduan,
            'user_type' => 'DESA',
            'user_id' => $staff->id,
            'content' => $request->content,
            'photo' => $url
        ]);
        // add notification
        $data_pengaduan = Pengaduan::find($pengaduan);
        $device = Device::join('penduduk', 'devices.penduduk_id', '=', 'penduduk.id')
                            ->where('penduduk.id', $data_pengaduan->penduduk_id)
                            ->select('devices.*')->first();

        Notification::send([
                    'title' => 'Tindak lanjut dari '.$staff->pamong_nama,
                    'body' => $data->content,
                    'to' => $device->device_id,
                    'click_action' => ''
                ]);
        // end notification
        return $this->successResponse($data);
    }

    //Reply Pengaduan by Kadus
    public function replyByKadus(Request $request, $pengaduan)
    {
        $key = $request->bearerToken();
        $desa_id = $request->header('DesaId');
        $kadus = KepalaDusun::select('kepala_dusun.*','wilayah.desa_id as desa_id')
                                    ->join('wilayah','wilayah.id','=','kepala_dusun.dusun_id')
                                    ->where([['api_key', $key],['wilayah.desa_id', $desa_id]])
                                    ->first();

        if ($kadus == null) {
                $msg = "Invalid Credentials";
                return $this->errorResponse($msg);
        }

        if ($request->file('photo') !== null) {
             $url = $this->uploadFileToS3($request);
        } else {
            $url = null;
        }

        $data = PengaduanComment::create([
            'desa_id' => $desa_id,
            'pengaduan_id' => $pengaduan,
            'user_type' => 'KADUS',
            'user_id' => $kadus->id,
            'content' => $request->content,
            'photo' => $url
        ]);

        // add notification
        $data_pengaduan = Pengaduan::find($pengaduan);
        $device = Device::join('penduduk', 'devices.penduduk_id', '=', 'penduduk.id')
                            ->where('penduduk.id', $data_pengaduan->penduduk_id)
                            ->select('devices.*')->first();

        Notification::send([
                    'title' => 'Tindak lanjut dari '.$kadus->name,
                    'body' => $data->content,
                    'to' => $device->device_id,
                    'click_action' => ''
                ]);
        // end notification
        return $this->successResponse($data);
    }


    public function uploadFileToS3($request)
    {
        $image = $request->file('photo');

        // Generate streamed file.
        $s3 = \Storage::disk('s3');

        $imageFileName = md5(time()) . md5($image->getClientOriginalName());
        $imageFileName = $s3->putFile('pengaduan_comment', $image, 'public');
        $publicURI = "https://" . env('AWS_URL') . "/" . env('AWS_BUCKET') . "/" . $imageFileName;
        return $publicURI;
    }

}
