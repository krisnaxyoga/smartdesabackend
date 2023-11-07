<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Cctv;

class CctvController extends Controller
{
    /**
     * @api {get} api/cctv/ Request CCTV List
     * @apiName GetCctvIndex
     * @apiGroup Cctv
     */
    public function index()
    {
        $data = Cctv::all();

        return response()->json($data, 200);
    }


    /**
     * @api {get} api/cctv/{id} Request CCTV Detail
     * @apiName GetCctvShow
     * @apiGroup Cctv
     */
    public function show($id)
    {
        $data = Cctv::find($id);

        return response()->json($data, 200);
    }
}
