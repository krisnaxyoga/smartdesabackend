<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetailPendudukPendatang;

class DetailPendudukPendatangController extends Controller
{

    public function store(Request $request, $id)
    {
       try {
            $nik_anggota = $request->nik_detail;
            $nama_anggota = $request->nama_detail;
            $sex_anggota = $request->sex_detail;
            $tgl_lahir_anggota = $request->umur_detail;
            $status_kawin_anggota = $request->status_kawin_detail;
            $pendidikan_anggota = $request->pendidikan_detail;
            $status_keluarga_anggota = $request->status_keluarga_detail;
            $ket_anggota = $request->ket_detail;

            foreach ($nik_anggota as $key => $value) {
                $anggota = new DetailPendudukPendatang();

                $anggota->duktang_id = $id;
                $anggota->nik = $nik_anggota[$key];
                $anggota->nama = $nama_anggota[$key];
                $anggota->sex_id = $sex_anggota[$key];
                $anggota->tanggallahir = $tgl_lahir_anggota[$key];
                $anggota->status_kawin_id = $status_kawin_anggota[$key];
                $anggota->pendidikan_id = $pendidikan_anggota[$key];
                $anggota->status_keluarga_id = $status_keluarga_anggota[$key];
                $anggota->keterangan = $ket_anggota[$key];
                $anggota->save();
            }

            return redirect()->route('penduduk-pendatang.show', $id);

       } catch (\Throwable $e) {
           return redirect()->back()->withErrors([$e->getMessage() . " at line " . $e->getLine()]);
       }
    }


    public function edit($id)
    {
        $data = DetailPendudukPendatang::find($id);

        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        try {

            $data = DetailPendudukPendatang::find($id);

            if (!$data) {
                return response()->json(['error' => true, 'message' => 'Data not Found']);
            }

            $data->fill($request->all());
            $data->save();

            if ($request->ajax()) {
                return response()->json([
                    'error' => false,
                    'message' => 'Data Anggota Keluarga successfully updated.'
                ]);
            }
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'error' => false,
                    'message' => 'Data Anggota Keluarga failed to updated.'
                ]);
            }
        }
    }

    public function destroy(Request $request, $id)
    {
        try {

           DetailPendudukPendatang::find($id)->delete();

            if ($request->ajax()) {
                return response()->json([
                    'error' => false,
                    'message' => 'Data Anggota Keluarga successfully deleted.'
                ]);
            }

            return redirect()->back()->with('success', 'Data Anggota Keluarga successfully deleted.');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'error' => false,
                    'message' => 'Data Anggota Keluarga failed to delete.'
                ]);
            }

            return redirect()->back()->with('error', 'Data Anggota Keluarga failed to delete.');
        }
    }
}
