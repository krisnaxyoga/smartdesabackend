<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Auth, DB;

use App\Notification as LogNotification;
use App\Utils\Notification;

class NotificationController extends Controller
{

    public function index(Request $request)
    {
        $desa_id = $request->header('DesaId');

        $notification = LogNotification::where('desa_id', '=', $desa_id)->orderBy('created_at', 'DESC');

        $paging = 20;
        if (isset($request->paging)) {
            $paging = $request->paging;
        }
        $notification =  $notification->paginate($paging);

        return response()->json($notification);
    }

}
