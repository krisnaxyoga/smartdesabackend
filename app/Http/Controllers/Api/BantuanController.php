<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Program;
use App\ProgramPeserta;

class BantuanController extends Controller
{
    public function index(Request $request)
    {
        $query = ProgramPeserta::join('program','program.id','=','program_peserta.program_id')->with(['program','penduduk' => function ($query) {
            $query->with('penduduk_map');
        }]);

        if ($request->filled('desa_id')) {
            $query->where('desa_id', $request->get('desa_id'));
        }

        if ($request->filled('group')) {
            $query->whereIn('program_id', $request->get('group'));
        }

        $data = $query->get();

        return response()->json($data);
    }
}
