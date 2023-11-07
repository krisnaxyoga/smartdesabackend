<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Lokasi;
use App\TipeLokasi;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LocationController extends Controller
{
    public function index(Request $request)
    {
        $query = Lokasi::with('tipeLokasi')
            ->where(['enabled' => 1])
            ->whereIn('tipe_lokasi_id', $request->get('tipe_lokasi_id', []) ?? []);

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
        $data = TipeLokasi::where('enabled', 1)->get();

        return response()->json($data);
    }
}
