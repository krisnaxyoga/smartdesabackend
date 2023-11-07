<?php

namespace App\Http\Controllers;

use App\Desa;
use App\Program;
use App\KelompokMaster;
use App\Keluarga;
use App\KeluargaSejahtera;
use App\KepalaDusun;
use App\Lokasi;
use App\Penduduk;
use App\PendudukMap;
use App\PendudukSex;
use App\PendudukStatus;
use App\TipeArea;
use App\TipeGaris;
use App\TipeLokasi;
use App\Wilayah;
use Illuminate\Http\Request;

class PetaController extends Controller
{
    /**
     * Display map.
     */
    public function index(Request $request)
    {
        if (auth()->user() == null && $request->token != "guest") {
            if (!$this->handleAuth()) {
                return redirect('/gis/login');
            }
        }

        $values = [];
        $values['type'] = $request->type;
        $values['regions'] = Wilayah::orderBy('dusun', 'ASC')->get();
        $values['regionareas'] = Wilayah::orderBy('dusun', 'ASC')->whereNotNull('coordinate')->get();
        $values['villageData'] = Desa::find($request->get('desa_id') ?? (auth()->user() ? auth()->user()->desa_id : null));

        if ($request->type == 'family' || empty($request->type)) {
            $values['social_class'] = KeluargaSejahtera::get();
        }

        if ($request->type == 'citizen' || empty($request->type)) {
            $values['statuses'] = PendudukStatus::get();
            $values['sexes'] = PendudukSex::get();
            $values['indicators'] = collect([
                [
                    'name' => 'agama',
                    'label' => 'Agama'
                ],
                [
                    'name' => 'pekerjaan',
                    'label' => 'Pekerjaan'
                ],
                [
                    'name' => 'status_penduduk',
                    'label' => 'Status Penduduk'
                ],
                [
                    'name' => 'warganegara',
                    'label' => 'Kewarganegaraan'
                ],
                [
                    'name' => 'suku',
                    'label' => 'Suku'
                ],
                [
                    'name' => 'ktp',
                    'label' => 'Kepemilikan Wajib KTP'
                ],
                [
                    'name' => 'status_kawin',
                    'label' => 'Status Perkawinan'
                ],
                [
                    'name' => 'golongan_darah',
                    'label' => 'Golongan Darah'
                ],
                [
                    'name' => 'pendidikan_kk',
                    'label' => 'Pendidikan dalam KK'
                ],
                [
                    'name' => 'pendidikan',
                    'label' => 'Pendidikan sedang Ditempuh'
                ],
                [
                    'name' => 'cacat',
                    'label' => 'Penyandang Cacat'
                ],
                [
                    'name' => 'umur',
                    'label' => 'Umur'
                ]
            ]);
        }

        if ($request->type == 'social' || empty($request->type)) {
            $values['groupTypes'] = Program::orderBy('nama', 'ASC')->where('desa_id',$values['villageData']->id)->get();
        }

        if ($request->type == 'village' || empty($request->type)) {
            $values['areaTypes'] = TipeArea::orderBy('name', 'ASC')->where('enabled', 1)->get();
            $values['lineTypes'] = TipeGaris::orderBy('name', 'ASC')->where('enabled', 1)->get();
            $values['locationTypes'] = TipeLokasi::orderBy('name', 'ASC')->where('enabled', 1)->get();
        }

        return view('gis.index', $values);
    }

    /**
     * Filter citizens.
     *
     * @param  Request  $request
     * @return Response
     */
    public function filter(Request $request)
    {
        $query = Penduduk::select('penduduk.id', 'penduduk.nama', 'wilayah.dusun AS dusun', 'penduduk.nik', 'penduduk.status', 'penduduk_sex.nama AS sex', 'penduduk_status.nama AS status', 'penduduk_map.lat', 'penduduk_map.lng', 'penduduk.foto', 'penduduk.alamat_sekarang')
            ->join('wilayah', 'wilayah.id', '=', 'penduduk.dusun_id', 'left')
            ->join('penduduk_sex', 'penduduk_sex.id', '=', 'penduduk.sex', 'left')
            ->join('penduduk_status', 'penduduk_status.id', '=', 'penduduk.status', 'left')
            ->join('penduduk_map', 'penduduk_map.penduduk_id', '=', 'penduduk.id', 'left')
            ->whereHas('penduduk_map');

        if ($request->has('status') && $request->get('status') !== '0') {
            $query->where('penduduk.status', $request->get('status'));
        }

        if ($request->has('sex') && $request->get('sex') !== '0') {
            $query->where('penduduk.sex', $request->get('sex'));
        }

        if ($request->has('region') && $request->get('region') !== '0') {
            $query->where('penduduk.dusun_id', $request->get('region'));
        }

        if ($request->has('name')) {
            $query->where('penduduk.nama', 'LIKE', '%' . $request->get('name') . '%');
        }

        if ($request->has('nik')) {
            $query->where('penduduk.nik', 'LIKE', '%' . $request->get('nik') . '%');
        }

        $data = $query->get();

        return response()->json($data);
    }

    public function family(Request $request)
    {
        $query = Keluarga::select('keluarga.*', 'wilayah.dusun as nama_dusun', 'penduduk.nama as kepala_keluarga', 'penduduk.nik as kepala_nik', 'penduduk.alamat_sekarang as alamat_sekarang', 'keluarga_sejahtera.nama AS social_class')
            ->join('wilayah', 'wilayah.id', '=', 'keluarga.id_cluster')
            ->join('keluarga_sejahtera', 'keluarga_sejahtera.id', '=', 'keluarga.kelas_sosial')
            ->join('penduduk', 'penduduk.nik', '=', 'keluarga.nik_kepala')
            ->with([
                'penduduk' => function ($penduduk) {
                    $penduduk->with([
                        'jenisKelamin'
                    ])->orderBy('kk_level', 'ASC')->orderBy('tanggallahir', 'ASC');
                }
            ]);

        if ($request->has('social_class') && $request->get('social_class') !== '0') {
            $query->where('keluarga.kelas_sosial', $request->get('social_class'));
        }

        if ($request->has('region') && $request->get('region') !== '0') {
            $query->where('keluarga.id_cluster', $request->get('region'));
        }

        if ($request->has('no_kk')) {
            $query->where('keluarga.no_kk', 'LIKE', '%' . $request->get('no_kk') . '%');
        }
        if ($request->has('anggota')) {
            $query->where('penduduk.nama', 'LIKE', '%' . $request->get('anggota') . '%');
            // $query->whereHas('penduduk', function($q) use($request){
            //     return $q->where('penduduk.nama', 'LIKE','%'. $request->get('anggota') .'%');
            // });
        }

        $data = $query->get();
        return response()->json($data);
    }

    /**
     * Handle auth.
     */
    public function handleAuth()
    {
        $token = session()->get('gis_token') ?: request()->get('token');
        $citizen = Penduduk::where('token', $token)->first();

        if ($citizen === null) {
            $kadus = KepalaDusun::where('api_key', $token)->first();

            return $kadus !== null;
        }

        return true;
    }

    /**
     * Handle auth.
     */
    public function loginForm()
    {
        $values['months'] = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

        return view('gis.login', $values);
    }

    /**
     * Handle auth.
     */
    public function login(Request $request)
    {
        $dob = $request->get('dob');

        if ($dob == null) {
            $dob = date('Y-m-d', mktime(0, 0, 0, ($request->month + 1), $request->date, $request->year));
        }

        $citizen = Penduduk::where('nik', $request->get('nik'))
            ->where('tanggallahir', $dob)
            ->first();

        if ($citizen == null) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'NIK atau Tanggal Lahir salah.');
        }

        if ($citizen->token == null) {
            $citizen->token = hash_hmac('sha256', rand(11111111, 99999999) . microtime(), 'simadu-colony');
            $citizen->save();
        }

        session(['gis_token' => $citizen->token]);

        return redirect('/gis');
    }

    /**
     * Handle logout.
     */
    public function logout(Request $request)
    {
        session()->forget('gis_token');

        return redirect('/gis');
    }

    /**
     * Statistics API.
     */
    public function statistic()
    {
        if (auth()->user() == null) {
            if (!$this->handleAuth()) {
                return redirect('/gis/login');
            }
        }

        $dusun_filter = [];
        $indicator = $request->get('indicator', 'pekerjaan');
        switch ($indicator) {
            case 'golongan_darah':
                $label = 'Golongan Darah';
                $field = 'golongan_darah_id';
                $groups = GolonganDarah::get();
                break;

            case 'pekerjaan':
                $label = 'Pekerjaan';
                $field = 'pekerjaan_id';
                $groups = PendudukPekerjaan::get();
                break;

            case 'status_penduduk':
                $label = 'Status Penduduk';
                $field = 'status';
                $groups = PendudukStatus::get();
                break;

            case 'pendidikan_kk':
                $label = 'Pendidikan dalam KK (Tamat)';
                $field = 'pendidikan_kk_id';
                $groups = PendudukPendidikanKK::get();
                break;

            case 'pendidikan':
                $label = 'Pendidikan Sedang Ditempuh';
                $field = 'pendidikan_sedang_id';
                $groups = PendudukPendidikan::get();
                break;

            case 'status_kawin':
                $label = 'Status Perkawinan';
                $field = 'status_kawin_id';
                $groups = PendudukKawin::get();
                break;

            case 'agama':
                $label = 'Agama';
                $field = 'agama_id';
                $groups = PendudukAgama::get();
                break;

            case 'cacat':
                $label = 'Penyandang Cacat';
                $field = 'cacat_id';
                $groups = Cacat::get();
                break;

            case 'warganegara':
                $label = 'Kewarganegaraan';
                $field = 'warganegara_id';
                $groups = PendudukWarganegara::get();
                break;

            case 'suku':
                $label = 'Suku';
                $field = 'suku_id';
                $groups = Suku::get();
                break;

            case 'ktp':
                $label = 'Kepemilikan Wajib KTP';
                $field = 'status_rekam_id';
                $groups = KtpStatus::get();
                break;

            case 'umur':
                $label = 'Umur';
                $field = 'umur';
                $groups = range(0, 110);
                break;
        }

        $data['label'] = $label;

        $dusun_id_list = Wilayah::select('id')->pluck('id')->all();
        if ($request->has('dusun') && in_array($request->get('dusun'), $dusun_id_list)) {
            $dusun_filter = [
                'dusun_id' => $request->get('dusun')
            ];
        }

        $lists = [];

        $total = Penduduk::where($dusun_filter)->count();

        if ($total == 0) {
            $total = 1;
        }

        $subto = 0;

        foreach ($groups as $group) {
            $groupName = '';

            if ($field == 'umur') {
                $groupName = $group . ' tahun';
                $ageCalculation = "ROUND(DATEDIFF(CURRENT_DATE, `tanggallahir`) / 365)";

                $to = Penduduk::select('*')
                    ->where($dusun_filter)
                    ->whereRaw($ageCalculation . ' = ' . $group)
                    ->count();
            } else {
                $groupName = $group->nama;
                $to = Penduduk::where($dusun_filter)->where($field, $group->id)->count();
            }

            $subto += $to;
            $x = [
                'group' => $groupName,
                'total' => [
                    'count' => $to,
                    'percent' => number_format(($to / $total) * 100, 1, ',', '.')
                ]
            ];
            $lists[] = $x;
        }

        $items['lists'] = $lists;
        $items['subtotal'] = [
            'male' => [
                'percent' => number_format(($subtom / $total * 100), 1, ',', '.'),
                'count' => $subtom
            ],
            'female' => [
                'percent' => number_format(($subtof / $total * 100), 1, ',', '.'),
                'count' => $subtof
            ],
            'count' => $subto,
            'percent' => number_format(($subto / $total) * 100, 1, ',', '.')
        ];
        $empty = $total - $subto;

        $items['empty'] = [
            'count' => $empty,
            'percent' => number_format(($empty / $total) * 100, 1, ',', '.'),
        ];
        $items['total'] = [
            'count' => $total,
        ];

        $data['items'] = $items;
        $data['indikator'] = $indicator;

        return response()->json($data);
    }
}
