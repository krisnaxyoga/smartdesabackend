<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Auth, DB;

use App\Desa;
use App\Helpers\CloudStorage;

class DesaController extends Controller
{
    /**
     * Controller construction.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Index page.
     * 
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $data = Desa::find($user->desa_id);
        return view('desa.index', [
            'data' => $data,
            'page_title' => "Edit Info Desa"
        ]);
    }

    /**
     * Store resource.
     * 
     * @param  Request  $request
     * @return Response
     */
    public function update(Request $request)
    {
        $user = auth()->user();
        $data = Desa::find($user->desa_id);

        $data->update([
            'nama_desa'         => $request->get('nama_desa', $data->nama_desa),
            'kode_desa'         => $request->get('kode_desa', $data->kode_desa),
            'nama_kepala_desa'  => $request->get('nama_kepala_desa', $data->nama_kepala_desa),
            'nip_kepala_desa'   => $request->get('nip_kepala_desa', $data->nip_kepala_desa),
            'kode_pos'          => $request->get('kode_pos', $data->kode_pos),
            'nama_kecamatan'    => $request->get('nama_kecamatan', $data->nama_kecamatan),
            'kode_kecamatan'    => $request->get('kode_kecamatan', $data->kode_kecamatan),
            'nama_kepala_camat' => $request->get('nama_kepala_camat', $data->nama_kepala_camat),
            'nip_kepala_camat'  => $request->get('nip_kepala_camat', $data->nip_kepala_camat),
            'nama_kabupaten'    => $request->get('nama_kabupaten', $data->nama_kabupaten),
            'kode_kabupaten'    => $request->get('kode_kabupaten', $data->kode_kabupaten),
            'nama_propinsi'     => $request->get('nama_propinsi', $data->nama_propinsi),
            'kode_propinsi'     => $request->get('kode_propinsi', $data->kode_propinsi),
            'logo'              => $request->get('logo', $data->logo),
            'logo_landscape_white' => $request->get('logo_landscape_white', $data->logo_landscape_white),
            'logo_landscape_black' => $request->get('logo_landscape_black', $data->logo_landscape_black),
            'lat'               => $request->get('lat', $data->lat),
            'lng'               => $request->get('lng', $data->lng),
            'zoom'              => $request->get('zoom', $data->zoom),
            'map_tipe'          => $request->get('map_tipe', $data->map_tipe),
            'path'              => $request->get('path', $data->path),
            'alamat_kantor'     => $request->get('alamat_kantor', $data->alamat_kantor),
            'g_analytic'        => $request->get('g_analytic', $data->g_analytic),
            'email_desa'        => $request->get('email_desa', $data->email_desa),
            'telepon'           => $request->get('telepon', $data->telepon),
            'website'           => $request->get('website', $data->website)
        ]);

        if ($request->hasFile('logo')) {
            $url = CloudStorage::upload($request->file('logo'));

            $data->logo = $url;
            $data->save();
        }

        if ($request->hasFile('logo_landscape_white')) {
            $url = CloudStorage::upload($request->file('logo_landscape_white'));

            $data->logo_landscape_white = $url;
            $data->save();
        }

        if ($request->hasFile('logo_landscape_black')) {
            $url = CloudStorage::upload($request->file('logo_landscape_black'));

            $data->logo_landscape_black = $url;
            $data->save();
        }

        return redirect()->back()->with('success', 'Informasi desa sudah berhasil diupdate.');
    }

    /**
     * Delete resource.
     * 
     * @param  Request  $request
     * @param  String   $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
       
    }
}
