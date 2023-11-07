<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\DetailInventaris;
use App\Inventaris;

class InventarisBarcodeController extends Controller
{
    public function PrintBarcodeDetail($id, $id_stok)
    {
        $data = DetailInventaris::find($id_stok);

        return view('inventaris.detail-inventaris.print', [
            'data' => $data
        ]);
    }

    public function PrintBarcode($id)
    {
        $data = DetailInventaris::where('inventaris_id', $id)->get();

        //return response()->json($data);

        return view('inventaris.print', [
            'data' => $data
        ]);
    }
}
