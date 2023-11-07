<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PengaduanCategories;
use Validator;

class PengaduanCategoriesController extends BaseApiController
{
    public function index(Request $request)
    {
        
        $desa_id = $request->header('DesaID');
        $data = PengaduanCategories::where('desa_id', $desa_id)->get();
        return $this->successResponse($data);
        
    }
}
