<?php

namespace App\Http\Controllers\Api;

use App\Garis;

use App\Http\Controllers\Controller;
use App\TipeGaris;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TypologyController extends Controller
{
    public function index(Request $request)
    {
        $query = Garis::with('tipeGaris')
            ->where(['enabled' => 1])
            ->whereIn('tipe_garis_id', $request->get('tipe_garis_id', []) ?? []);

        if ($request->filled('desa_id')) {
            $query->where('desa_id', $request->get('desa_id'));
        }

        $data = $query->get();
        return response()->json($data);
    }

    public function category(Request $request)
    {
        $data = TipeGaris::where('enabled', 1)->get();

        return response()->json($data);
    }
}
