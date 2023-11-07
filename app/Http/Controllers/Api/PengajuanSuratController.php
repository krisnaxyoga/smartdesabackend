<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\KepalaDusun;
use App\PengajuanSurat;
use Illuminate\Http\Request;

class PengajuanSuratController extends BaseApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $key = $request->bearerToken();
        $kadus = KepalaDusun::where('api_key', $key)->first();

        $data = PengajuanSurat::where('dusun_id', $kadus->dusun_id)->with(['penduduk' => function ($query) {
            $query->select('id', 'nik', 'nama');
        }, 'jenisSurat' => function ($query) {
            $query->select('id', 'judul', 'kode_surat');
        }, 'dusun' => function ($query) {
            $query->select('id', 'dusun');
        }]);

        if (isset($request->status)) {
            $data = $data->where('status', $request->status);
        }

        if ($request->filled('desa_id')) {
            $query->where('desa_id', $request->get('desa_id'));
        }

        // if(isset($request->dusun_id)) {
        //     $data = $data->where('dusun_id',$request->dusun_id);
        // }
        $data = $data->orderBy('pengajuan_surat.created_at', 'desc')->paginate($request->get('paging', 100));

        return $this->successResponse($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = PengajuanSurat::with(['penduduk', 'jenisSurat', 'dusun'])->where('id', $id)->first();
        return $this->successResponse($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function accept(Request $request, $id)
    {
        $key = $request->bearerToken();
        $user = $this->getUser($key);

        $pengajuanSurat = PengajuanSurat::find($id);
        if ($pengajuanSurat->dusun_id != $user->dusun_id) {
            return $this->errorResponse("Surat bukan untuk dusun anda!");
        }

        $pengajuanSurat->update([
            'status' => "ACCEPTED",
            'tanggal_verifikasi' => date('Y-m-d'),
            'no_surat_pengantar' => $request->no_surat_pengantar
        ]);

        return $this->successResponse($pengajuanSurat);
    }

    public function reject(Request $request, $id)
    {
        $key = $request->bearerToken();
        $user = $this->getUser($key);

        $pengajuanSurat = PengajuanSurat::find($id);
        if ($pengajuanSurat->dusun_id != $user->dusun_id) {
            return $this->errorResponse("Surat bukan untuk dusun anda!");
        }

        $pengajuanSurat->update([
            'status' => "REJECTED",
            'tanggal_verifikasi' => date('Y-m-d')
        ]);

        return $this->successResponse($pengajuanSurat);
    }

    public function changePassword(Request $request)
    {
        $key = $request->bearerToken();
        $user = $this->getUser($key);

        $data = KepalaDusun::find($user->id);

        $data->update([
            'pin' => bcrypt($request->pin)
        ]);

        return $this->successResponse($pengajuanSurat);
    }

    public function track(Request $request)
    {
        if (!$request->has('keyword')) {
            return $this->errorResponse("Nomor surat tidak ditemukan");
        }

        $key = $request->bearerToken();
        $user = $this->getUser($key);
        $keyword = $request->keyword;

        $surat = PengajuanSurat::where('track_number', $keyword)
            ->where('dusun_id', $user->dusun_id)
            ->first();

        if (!$surat) {
            return $this->errorResponse("Nomor surat tidak ditemukan");
        }
        return $this->successResponse($surat);
    }
}
