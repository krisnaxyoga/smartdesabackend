<?php

namespace App\Http\Controllers\Api;

use App\Device;
use App\Http\Controllers\Controller;
use App\DesaPamong;
use App\Pengaduan;
use App\PengaduanComment;
use App\Utils\Notification;
use Hash;
use Illuminate\Http\Request;
use Validator;

class PamongController extends BaseApiController
{
    /**
     * Login Kepala Dusun
     * @return Response
     * @param Illuminate\Http\Request;
     */

    public function login(Request $request)
    {

        $validation = Validator::make($request->all(), [
            'username' => 'required|exists:desa_pamong,username',
            'password' => 'required'
        ]);

        if ($validation->fails()) {
            $errMsg = $this->getValidationErrorMessage($validation);

            //Output Error
            return $this->errorResponse($errMsg);
        }
        
        $check = DesaPamong::where([['username', $request->username],['desa_id', $request->header('DesaId')]])->first();
          
        if (!$check)
            return $this->errorResponse('Username tidak valid');

        if (!Hash::check($request->password, $check->password))
            return $this->errorResponse('Password untuk username tersebut tidak valid');

        $check->update([
            'token' => base64_encode("pamong".$check->username.":".$check->pamong_nama)
        ]);
        if (($request->header('DeviceID')) !== null) {

                // Delete existing device IDs from this user.
            $devices = Device::where(['staff_id' => $check->id])->delete();

                // Add device ID if not exists.
            $device = Device::create([
                'staff_id' => $check->id,
                'device_id' => $request->header('DeviceID')
            ]);
        }

        return $this->successResponse($check);
    }

    public function logout(Request $request)
    {
        $key = $request->bearerToken();
        $desa_id = $request->header('DesaID');

        $user = DesaPamong::where([['token', $key],['desa_id', $desa_id]])->first();
        if ($user == null) {
            $msg = "Invalid Credentials";
            return $this->errorResponse($msg);
        }

        $device_id = $request->header('DeviceID');
        Device::where('staff_id', $user->id)->where('device_id', $device_id)->delete();
        return $this->successResponseNoData();
    }

    //Daftar Pengaduan by Staff Desa
    public function daftarPengaduan(Request $request)
    {
        $key = $request->bearerToken();
        $desa_id = $request->header('DesaId');
        $disposisi = DesaPamong::where([['token', $key],['desa_id',$desa_id]])->first();

        if ($disposisi == null) {
            $msg = "Invalid Credentials";
            return $this->errorResponse($msg);
        }

        $data = Pengaduan::select('pengaduans.*')
                        ->where([
                            ['user_target', '=', 'DESA'],
                            ['user_id', $disposisi->id]
                        ])
                        ->with([
                            'pelapor' => function($query){
                            $query->select('id', 'nik','nama');
                        },  'category' => function($query){
                            $query->select('id','name');
                        }])
                        ->join('pengaduan_categories', 'pengaduan_categories.id', '=', 'pengaduans.pengaduan_category_id')
                        ->orderBy('created_at','DESC');
        $paging = 20;
        if (isset($request->paging)) {
            $paging = $request->paging;
        }
        $data = $data->paginate($paging);
        return $this->successResponse($data);
    }
}
