<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\JenisSurat;

class JenisSuratController extends BaseApiController
{
    public function index(Request $request)
    {
        //
        $key = $request->bearerToken();

        $data = JenisSurat::select("*")->where('is_mobile',1);

        if(isset($request->kode)) {
            $data = $data->where('kode','like',"%$request->kode%");
        }

        if(isset($request->judul)) {
            $data = $data->where('judul','like',"%$request->judul%");
        }

        // $paging = 5;

        // if(isset($request->paging)) {
        //     $paging = $request->paging;
        // }
        // $data = $data->paginate($paging);

        return $this->successResponse($data->get());
            
    }
}
