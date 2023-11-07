<?php

namespace App\Http\Controllers\Api;

use App\Area;

use App\Http\Controllers\Controller;
use App\TipeArea;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AreaController extends Controller
{
    public function index(Request $request)
    {
        $query = Area::with('tipeArea')
            ->where(['enabled' => 1])
            ->whereIn('tipe_area_id', $request->get('tipe_area_id', []) ?? []);

        if ($request->filled('desa_id')) {
            $query->where('desa_id', $request->get('desa_id'));
        }

        if ($request->filled('dusun')) {
            $dusun = explode(',', $request->get('dusun'));
            $query->whereIn('dusun_id', $dusun);
        }

        $data = $query->get();

        return response()->json($data);
    }

    public function category(Request $request)
    {
        $data = TipeArea::where('enabled', 1)->get();

        return response()->json($data);
    }
}
