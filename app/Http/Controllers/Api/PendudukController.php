<?php

namespace App\Http\Controllers\Api;

use App\Desa;

use App\Device;
use App\Http\Controllers\Controller;
use App\Notification as LogNotification;

use App\Penduduk;

use App\PendudukSex;
use App\PendudukStatus;
use App\Pengaduan;

use App\PengaduanComment;
use App\PengajuanSurat;
use App\Utils\Notification;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;

class PendudukController extends BaseApiController
{
    public function index(Request $request)
    {
        if ($request->type != "select2") {
            $page = $request->get('page');
            $per_page = $request->get('per_page');
            $query = Penduduk::select('penduduk.id', 'penduduk.nama', 'wilayah.dusun AS dusun', 'penduduk.nik', 'penduduk.status', 'penduduk_sex.nama AS sex', 'penduduk_status.nama AS status', 'penduduk_map.lat', 'penduduk_map.lng', 'penduduk.foto')
                ->join('wilayah', 'wilayah.id', '=', 'penduduk.dusun_id')
                ->join('penduduk_sex', 'penduduk_sex.id', '=', 'penduduk.sex')
                ->join('penduduk_status', 'penduduk_status.id', '=', 'penduduk.status')
                ->join('penduduk_map', 'penduduk_map.penduduk_id', '=', 'penduduk.id', 'left');

            if ($request->has('status') && $request->get('status') !== '0') {
                $query->where('penduduk.status', $request->get('status'));
            }

            if ($request->has('sex') && $request->get('sex') !== '0') {
                $query->where('penduduk.sex', $request->get('sex'));
            }

            if ($request->has('region') && $request->get('region') !== '0') {
                $query->where('penduduk.dusun_id', $request->get('region'));
            }

            if ($request->has('nama')) {
                $query->where('penduduk.nama', 'LIKE', '%' . $request->get('nama') . '%');
            }

            if ($request->has('nik')) {
                $query->where('penduduk.nik', 'LIKE', '%' . $request->get('nik') . '%');
            }

            if ($page !== null && $per_page !== null) {
                $query->skip(($page - 1) * $per_page);
                $query->take($per_page);
            }

            $data = $query->get();
        } else {
            $query = Penduduk::select('id', 'nama', 'alamat_sekarang', 'id_kk', 'no_kk_sebelumnya', 'tanggallahir', 'sex', 'warganegara_id', 'status_kawin_id', 'agama_id', 'pekerjaan_id', 'pendidikan_kk_id', 'nik', 'tempatlahir', 'dusun_id')
                ->with('agama', 'pendidikanKK', 'pekerjaan', 'dusun', 'kewarganegaraan', 'status_kawin', 'keluarga')
                ->where('penduduk.nama', 'like', "%$request->search%")
                ->orWhere('penduduk.nik', 'like', "%$request->search%");

            if ($request->filled('desa_id')) {
                $query->where('desa_id', $request->get('desa_id'));
            }

            $data = $query->get();
        }

        return response()->json($data);
    }

    /**
     * Display detail of the resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Penduduk::with('keluarga')
            ->with('agama')
            ->with('pendidikan')
            ->with('hubungan')
            ->with('pendidikanKK')
            ->with('pekerjaan')
            ->with('kewarganegaraan')
            ->with('jenis_kelahiran')
            ->with('sakit_menahun')
            ->with('cacat')
            ->with('cara_kb')
            ->with('tempat_dilahirkan')
            ->with('dusun')
            ->with('golonganDarah')
            ->with('penolong_kelahiran')
            ->with('status_kawin')
            ->with('penduduk_map')
            ->find($id);

        return response()->json($data);
    }

    public function sex()
    {
        $data = PendudukSex::get();

        return response()->json($data);
    }

    public function status()
    {
        $data = PendudukStatus::get();

        return response()->json($data);
    }

    public function searchPenduduk(Request $request)
    {
        $key = $request->bearerToken();
        if ($key === null) {
            return response()->json([
                'error' => true,
                'message' => 'API Key is missing!'
            ]);
        }

        $penduduk = Penduduk::where('token', $key)->first();
        if ($penduduk === null) {
            return response()->json([
                'error' => true,
                'message' => 'Invalid API Key!'
            ]);
        }

        // Start search.
        $searchBy = $request->get('search_by', 'nik');
        $like = $request->get('like', 0);
        $keyword = $request->get('keyword');

        $data = Penduduk::where($searchBy, $keyword)->first();

        return $data;
    }

    public function pendudukTanpaKelompok($kelompok_id)
    {
        // $penduduk = Penduduk::whereHas('kelompok',function($klp) use ($kelompok_id){
        //     $klp->where('kelompok_id','!=',$kelompok_id);
        // })->orWhere('')->get();

        $penduduk2 = Penduduk::select('penduduk.*', 'kelompok_anggota.kelompok_id')
            ->leftJoin('kelompok_anggota', 'penduduk.id', '=', 'kelompok_anggota.penduduk_id')
            ->whereNull('kelompok_id')
            ->orWhere('kelompok_id', '!=', $kelompok_id)
            ->get();

        return response()->json($penduduk2);
    }

    /**
     * Handle auth.
     */
    public function login(Request $request)
    {

        $citizen = Penduduk::where('nik', $request->get('nik'))
            ->where('tanggallahir', $request->get('dob'))->with([
            'keluarga',
            'desa',
            'jenisKelamin',
            'agama',
            'suku',
            'pendidikan',
            'hubungan',
            'pendidikanKK',
            'pekerjaan',
            'kewarganegaraan',
            'jenis_kelahiran',
            'sakit_menahun',
            'cacat',
            'cara_kb',
            'tempat_dilahirkan',
            'dusun',
            'golonganDarah',
            'penolong_kelahiran',
            'status_kawin',
            'penduduk_map',
        ])->first();


        $citizen = Penduduk::select(
            'penduduk.*',
            'penduduk_pekerjaan.nama AS pekerjaan',
            'wilayah.dusun AS dusun_name'
        )
            ->where('nik', $request->get('nik'))
            ->where('tanggallahir', $request->get('dob'))
            ->join('penduduk_pekerjaan', 'penduduk_pekerjaan.id', '=', 'penduduk.pekerjaan_id', 'left')
            ->join('wilayah', 'wilayah.id', '=', 'penduduk.dusun_id', 'left')
            ->first();


        if ($citizen == null) {
            return response()->json([
                'error' => true,
                'message' => 'NIK atau Tanggal Lahir salah.'
            ]);
        }

        if ($citizen->token == null) {
            $citizen->token = hash_hmac('sha256', rand(11111111, 99999999) . microtime(), 'simadu-colony');
            $citizen->save();
        }

        if (($request->header('DeviceID')) !== null) {
            // Delete existing device IDs from this user.
            $devices = Device::where(['penduduk_id' => $citizen->id])->delete();

            // Add device ID if not exists.
            $device = Device::create([
                'penduduk_id' => $citizen->id,
                'device_id' => $request->header('DeviceID')
            ]);

            return response()->json([
                'error' => false,
                'data' => $citizen
            ]);
        }
        return response()->json([
                'error' => false,
                'data' => $citizen
            ]);
    }

    public function daftarSurat(Request $request)
    {
        $key = $request->bearerToken();

        $penduduk = Penduduk::where('token', $key)->first();
        $data = PengajuanSurat::select('pengajuan_surat.id', 'keperluan', 'status', 'tanggal_pengajuan', 'jenis_surat_id', 'penduduk_id', 'dusun_id')->where('penduduk_id', $penduduk->id)->with(['penduduk' => function ($query) {
            $query->select('id', 'nik', 'nama');
        }, 'jenisSurat' => function ($query) {
            $query->select('id', 'judul', 'kode_surat');
        }, 'dusun' => function ($query) {
            $query->select('id', 'dusun');
        }])
            ->join('jenis_surat', 'jenis_surat.id', '=', 'pengajuan_surat.jenis_surat_id');

        if (isset($request->status)) {
            $data = $data->where('status', $request->status);
        }

        if (isset($request->q)) {
            $data->where(function ($query) use ($request) {
                $query->where('jenis_surat.judul', 'like', "%$request->q%");
                $query->orWhere('pengajuan_surat.track_number', 'like', "%$request->q%");
                $query->orWhere('pengajuan_surat.status', 'like', "%$request->q%");
            });
        }

        $paging = 100;

        if (isset($request->paging)) {
            $paging = $request->paging;
        }
        $data = $data->orderBy('pengajuan_surat.created_at', 'DESC');
        $data = $data->paginate($paging);

        return $this->successResponse($data);

        // return $this->successResponse($pengajuan);

    }

    public function update(Request $request)
    {
        $token = $request->bearerToken();

        $penduduk = Penduduk::where('token', $token)->first();

        $values = [];
        if($request->foto != null) {
            $values['foto'] = $request->foto;
        }

        $penduduk->update($values);
        $penduduk = Penduduk::where('token', $token)->with([
            'keluarga',
            'desa',
            'jenisKelamin',
            'agama',
            'suku',
            'pendidikan',
            'hubungan',
            'pendidikanKK',
            'pekerjaan',
            'kewarganegaraan',
            'jenis_kelahiran',
            'sakit_menahun',
            'cacat',
            'cara_kb',
            'tempat_dilahirkan',
            'dusun',
            'golonganDarah',
            'penolong_kelahiran',
            'status_kawin',
            'penduduk_map',
        ])->first();
        return $this->successResponse($penduduk);
    }

    public function ajukanSurat(Request $request)
    {
        $token = $request->bearerToken();

        $penduduk = Penduduk::where('token', $token)->first();

        $validation = Validator::make($request->all(), [
            'jenis_surat_id' => 'required|exists:jenis_surat,id'
        ]);

        if ($validation->fails()) {
            $msg = $this->getValidationErrorMessage($validation);
            return $this->errorResponse($msg);
        }

        $pengajuan = PengajuanSurat::create([
            'dusun_id' => $penduduk->dusun_id,
            'keperluan' => $request->keperluan,
            'penduduk_id' => $request->get('jenis_surat_id') == 17 ? $request->get('penduduk_id') : $penduduk->id,
            'nomor_surat' => $request->nomor_surat,
            'berlaku_dari' => $request->berlaku_dari,
            'berlaku_sampai' => $request->berlaku_sampai,
            'jenis_acara' => $request->jenis_acara,
            'no_surat_pengantar' => $request->no_surat_pengantar,
            'nama_usaha' => $request->nama_usaha,
            'alamat_usaha' => $request->alamat_usaha,
            'jenis_usaha' => $request->jenis_usaha,
            'nama_pasangan' => $request->nama_pasangan,
            'tahun_kawin' => $request->tahun_kawin,
            'lokasi_kawin' => $request->lokasi_kawin,
            'nama_dusun' => $request->nama_dusun,
            'nama_desa' => $request->nama_desa,
            'nama_kecamatan' => $request->nama_kecamatan,
            'nama_kabupaten' => $request->nama_kabupaten,
            'nama_provinsi' => $request->nama_provinsi,
            'tanggal_meninggal' => $request->tanggal_meninggal,
            'lokasi_meninggal' => $request->lokasi_meninggal,
            'penyebab_meninggal' => $request->penyebab_meninggal,
            'nama_pelapor' => $request->nama_pelapor,
            'nik_pelapor' => $request->nik_pelapor,
            'hubungan_pelapor' => $request->hubungan_pelapor,
            'pernyataan_status' => $request->pernyataan_status,
            'penduduk_id' => $penduduk->id,
            'jenis_surat_id' => $request->jenis_surat_id,
            'tanggal_pengajuan' => date('Y-m-d'),
            'is_mobile' => true,
            'status' => "ACCEPTED",
        ]);

        $pengajuan = PengajuanSurat::select('pengajuan_surat.*')->with('dusun', 'penduduk', 'jenisSurat')->where('id', $pengajuan->id)->first();

        $penduduk = Penduduk::find($pengajuan->penduduk_id);

        $devices = Device::join('kepala_dusun', 'devices.kadus_id', '=', 'kepala_dusun.id')
            ->where('kepala_dusun.dusun_id', $pengajuan->dusun_id)
            ->select('devices.*')
            ->get();

        foreach ($devices as $key => $value) {
            Notification::send([
                'title' => 'Permohonan Surat Masuk',
                'body' => 'Permohonan ' . $pengajuan->jenisSurat->judul . ' masuk oleh ' . $penduduk->nama,
                'to' => $value->device_id,
                'click_action' => 'KADUS_PERMOHONAN'
            ]);

            LogNotification::create([
                'description' => 'Permohonan ' . $pengajuan->jenisSurat->judul . ' baru oleh ' . $penduduk->nama . ' pada dusun ' . $pengajuan->dusun->dusun . ' pada ' . $pengajuan->konversiTgl(date('Y-m-d')),
                'ref_id' => $pengajuan->id,
                'ref_type' => "PERMOHONAN_SURAT"
            ]);
        }

        return $this->successResponse($pengajuan);
    }

    public function logout(Request $request)
    {
        $key = $request->bearerToken();
        $user = Penduduk::where('token', $key)->first();

        $device_id = $request->header('DeviceID');
        Device::where('penduduk_id', $user->id)->where('device_id', $device_id)->delete();
        return $this->successResponseNoData();
    }

    //Daftar Pengaduan by User Masyarakat
    public function listPengaduan(Request $request)
    {
        $key = $request->bearerToken();
        $desa_id = $request->header('DesaId');
        $pelapor = Penduduk::where([
            'token' => $key,
            'desa_id' => $desa_id
        ])->first();

        if ($pelapor == null) {
            $msg = "Invalid Credentials";
            return $this->errorResponse($msg);
        }

        $data = Pengaduan::select('pengaduans.*')
            ->where([['penduduk_id', $pelapor->id], ['pengaduans.desa_id', $desa_id]])
            ->with([
                'pelapor' => function ($query) {
                    $query->select('id', 'nik', 'nama');
                },  'category' => function ($query) {
                    $query->select('id', 'name');
                }
            ])
            ->join('pengaduan_categories', 'pengaduan_categories.id', '=', 'pengaduans.pengaduan_category_id')
            ->orderBy('created_at', 'DESC');
        $paging = 10;
        if (isset($request->paging)) {
            $paging = $request->paging;
        }
        $data = $data->paginate($paging);
        return $this->successResponse($data);
    }

    public function kirimPengaduan(Request $request)
    {
        $key = $request->bearerToken();
        $desa_id = $request->header('DesaId');
        $validation = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'pengaduan_category_id' => 'required',
        ]);
        if ($validation->fails()) {
            $msg = $this->getValidationErrorMessage($validation);
            return $this->errorResponse($msg);
        }
        $pelapor = Penduduk::where([['token', $key], ['desa_id', $desa_id]])->first();

        if ($pelapor == null) {
            $msg = "Invalid Credentials";
            return $this->errorResponse($msg);
        }

        if ($request->file('photo') !== null) {
            $url = $this->uploadFileToS3($request);
        } else {
            $url = null;
        }

        $pengaduan = Pengaduan::create([
            'desa_id' => $desa_id,
            'penduduk_id' => $pelapor->id,
            'pengaduan_category_id' => $request->pengaduan_category_id,
            'title' => $request->title,
            'content' => $request->content,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'user_target' => $request->user_id,
            'user_id' => $request->user_id,
            'rating' => $request->rating,
            'start_date' => date('Y-m-d'),
            'status' => "PUBLISH",
            'photo' => $url
        ]);
        // For no_pengaduan
        $id_pengaduan = $pengaduan->id;
        $data_desa = Desa::select('akronim')->where('id', $desa_id)->first();
        $akronim = $data_desa->akronim;
        $tahun = date('Y');
        $sequence_no = sprintf("%04s", $id_pengaduan);
        $no_pengaduan = $sequence_no . '/' . 'ADUAN' . '/' . $akronim . '/' . $tahun;

        $pengaduan->update([
            'no_pengaduan' => $no_pengaduan
        ]);
        // For no_pengaduan

        return $this->successResponse($pengaduan);
    }

    public function buatKomentar(Request $request, $pengaduan)
    {
        $key = $request->bearerToken();
        $desa_id = $request->header('DesaId');

        $validation = Validator::make($request->all(), [
            'content' => 'required',
        ]);
        if ($validation->fails()) {
            $msg = $this->getValidationErrorMessage($validation);
            return $this->errorResponse($msg);
        }
        $pelapor = Penduduk::where([['token', $key], ['desa_id', $desa_id]])->first();

        if ($pelapor == null) {
            $msg = "Invalid Credentials";
            return $this->errorResponse($msg);
        }

        if ($request->file('photo') !== null) {
            $url = $this->uploadFileComment($request);
        } else {
            $url = null;
        }

        $data = PengaduanComment::create([
            'desa_id' => $desa_id,
            'pengaduan_id' => $pengaduan,
            'user_type' => 'PENDUDUK',
            'user_id' => $pelapor->id,
            'content' => $request->content,
            'photo' => $url
        ]);

        //add notifikasi
        $data_pengaduan = Pengaduan::find($pengaduan);

        if ($data_pengaduan->user_target == "DESA") {

            $device = Device::join('desa_pamong', 'devices.staff_id', '=', 'desa_pamong.id')
                ->where('desa_pamong.id', $data_pengaduan->user_id)
                ->select('devices.*')->first();
        } else {
            $device = Device::join('kepala_dusun', 'devices.kadus_id', '=', 'kepala_dusun.id')
                ->where('kepala_dusun.id',  $data_pengaduan->user_id)
                ->select('devices.*')->first();
        }
        Notification::send([
            'title' => 'Komentar dari ' . $pelapor->nama,
            'body' => $data->content,
            'to' => $device->device_id,
            'click_action' => ''
        ]);
        // end notifikasi
        return $this->successResponse($data);
    }

    public function uploadFileToS3($request)
    {
        $image = $request->file('photo');

        // Generate streamed file.
        $s3 = \Storage::disk('s3');

        $imageFileName = md5(time()) . md5($image->getClientOriginalName());
        $imageFileName = $s3->putFile('pengaduan', $image, 'public');
        $publicURI = "https://" . env('AWS_URL') . "/" . env('AWS_BUCKET') . "/" . $imageFileName;
        return $publicURI;
    }

    public function uploadFileComment($request)
    {
        $image = $request->file('photo');

        // Generate streamed file.
        $s3 = \Storage::disk('s3');

        $imageFileName = md5(time()) . md5($image->getClientOriginalName());
        $imageFileName = $s3->putFile('pengaduan_comment', $image, 'public');
        $publicURI = "https://" . env('AWS_URL') . "/" . env('AWS_BUCKET') . "/" . $imageFileName;
        return $publicURI;
    }

    public function detailPenduduk($id)
    {
        $data = Penduduk::where('id',$id)->with([
            'keluarga',
            'desa',
            'jenisKelamin',
            'agama',
            'suku',
            'pendidikan',
            'hubungan',
            'pendidikanKK',
            'pekerjaan',
            'kewarganegaraan',
            'jenis_kelahiran',
            'sakit_menahun',
            'cacat',
            'cara_kb',
            'tempat_dilahirkan',
            'dusun',
            'golonganDarah',
            'penolong_kelahiran',
            'status_kawin',
            'penduduk_map',
        ])->first();

        if ($data) {
            return response()->json([
                'error' => false,
                'data' => $data
            ]);
        } else {
            return response()->json([
                'error' => true,
                'data' => null
            ]);
        }
    }

    public function infoKadus($id)
    {
        $data = Penduduk::where('id',$id)->first();

        $dusun = $data->dusun->kadus;

        if ($dusun) {
            return response()->json([
                'error' => false,
                'data' => $dusun
            ]);
        } else {
            return response()->json([
                'error' => true,
                'data' => null
            ]);
        }
    }
}
