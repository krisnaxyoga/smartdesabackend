<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Kelompok;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class KelompokController extends Controller
{
    public function index(Request $request)
    {
        $query = Kelompok::with(['kategori', 'ketua' => function ($query) {
            $query->with('penduduk_map');
        }]);

        if ($request->filled('desa_id')) {
            $query->where('desa_id', $request->get('desa_id'));
        }

        if ($request->filled('group')) {
            $query->whereIn('kelompok_master_id', $request->get('group'));
        }

        $data = $query->get();

        return response()->json($data);
    }
}
