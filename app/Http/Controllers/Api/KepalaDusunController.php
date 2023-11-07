<?php

namespace App\Http\Controllers\Api;

use App\Device;
use App\Http\Controllers\Controller;
use App\KepalaDusun;
use App\Utils\Notification;
use Hash;
use Illuminate\Http\Request;
use Validator;

class KepalaDusunController extends BaseApiController
{
    /**
     * Login Kepala Dusun
     * @return Response
     * @param Illuminate\Http\Request;
     */

    public function login(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'username' => 'required|exists:kepala_dusun,username',
            'pin' => 'required'
        ]);

        if ($validation->fails()) {
            $errMsg = $this->getValidationErrorMessage($validation);

            //Output Error
            return $this->errorResponse($errMsg);
        }

        $check = KepalaDusun::where('username', $request->username)->with('dusun')->first();

        if (!$check)
            return $this->errorResponse('Username tidak valid');

        if (!Hash::check($request->pin, $check->pin))
            return $this->errorResponse('Pin untuk username tersebut tidak valid');

        $check->update([
            'api_key' => base64_encode("kadus$check->username:$check->name")
        ]);

        if (($request->header('DeviceID')) !== null) {

            // Delete existing device IDs from this user.
            $devices = Device::where(['kadus_id' => $check->id])->delete();

            // Add device ID if not exists.
            $device = Device::create([
                'kadus_id' => $check->id,
                'device_id' => $request->header('DeviceID')
            ]);
        }


        return $this->successResponse($check);
    }

    public function logout(Request $request)
    {
        $key = $request->bearerToken();
        $user = $this->getUser($key);
        $device_id = $request->header('DeviceID');
        Device::where('kadus_id', $user->id)->where('device_id', $device_id)->delete();
        return $this->successResponseNoData();
    }

    public function test(Request $request)
    {
        $test = Notification::send([
            'title' => 'Permohonan Surat Masuk',
            'body' => 'Kontol harun cilik ',
            'to' => "ebK5fVjYOCU:APA91bG7MBUiwQVDLpMOuen6NUnqc8Cf5cqEm68hddGUSxWKShjdtY6xMUvt5E4V-vLepkehq_8-JmmZ5Y08PrYA9iQgqJ11jcJpJuOMPimQiTaBAHEXIzKO3UEOPNLxIVZ7t5qAWDHC",
            'click_action' => 'PUSH_NOTIF'
        ]);

        if ($test) {
            return $this->successResponse(["success"]);
        } else {
            return $this->errorResponse("error");
        }
    }


    public function changePassword(Request $request)
    {
        $key = $request->bearerToken();
        $user = $this->getUser($key);

        $data = KepalaDusun::find($user->id);

        $data->update([
            'pin' => bcrypt($request->pin)
        ]);

        return $this->successResponse($data);
    }
}
