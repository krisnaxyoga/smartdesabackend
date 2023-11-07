<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Wilayah;

class WilayahController extends Controller
{
    public function index(Request $request)
    {


        $data = Wilayah::whereIn('id',$request->region)->where('desa_id',$request->desa_id)->get();

        return response()->json($data);
    }
}
