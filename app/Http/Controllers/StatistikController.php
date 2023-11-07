<?php

namespace App\Http\Controllers;

use App\Cacat;
use App\GolonganDarah;

use App\KtpStatus;

use App\Penduduk;
use App\PendudukAgama;
use App\PendudukKawin;
use App\PendudukPekerjaan;
use App\PendudukPendidikan;
use App\PendudukPendidikanKK;
use App\PendudukStatus;
use App\PendudukWarganegara;
use App\Suku;
use App\Wilayah;
use Auth, DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StatistikController extends Controller
{
    /**
     * Create page.
     *
     * @param  Request  $request
     * @return Response
     */
    public function penduduk(Request $request)
    {
        $data['page_title'] = "Statistik Kependudukan";
        $dusun_filter = [];
        $indicator = isset($_GET['indicator']) ? $_GET['indicator'] : 'pekerjaan';
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

            case 'suku':
                $label = 'Suku';
                $field = 'suku_id';
                $groups = Suku::get();
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
        if (isset($_GET['dusun']) && in_array($_GET['dusun'], $dusun_id_list)) {
            $dusun_filter = [
                'dusun_id' => $_GET['dusun']
            ];
        }

        $lists = [];

        $total = Penduduk::where($dusun_filter)->count();
        $totalm = Penduduk::where($dusun_filter)->where('sex', 1)->count();
        $totalf = Penduduk::where($dusun_filter)->where('sex', 2)->count();

        if ($total == 0) {
            $total = 1;
        }

        if ($totalm == 0) {
            $totalm = 1;
        }

        if ($totalf == 0) {
            $totalf = 1;
        }

        $subto = 0;
        $subtom = 0;
        $subtof = 0;

        foreach ($groups as $group) {
            $to = 0;
            $groupName = '';

            if ($field == 'umur') {
                $groupName = $group . ' tahun';
                $ageCalculation = "ROUND(DATEDIFF(CURRENT_DATE, `tanggallahir`) / 365)";

                $mc = Penduduk::select('*')
                    ->where($dusun_filter)
                    ->whereRaw($ageCalculation . ' = ' . $group)
                    ->where('sex', 1)
                    ->count();

                $fc = Penduduk::select('*')
                    ->where($dusun_filter)
                    ->whereRaw($ageCalculation . ' = ' . $group)
                    ->where('sex', 2)
                    ->count();
            } else {
                $groupName = $group->nama;
                $mc = Penduduk::where($dusun_filter)->where($field, $group->id)->where('sex', 1)->count();
                $fc = Penduduk::where($dusun_filter)->where($field, $group->id)->where('sex', 2)->count();
            }

            $subtom += $mc;
            $subtof += $fc;

            $to = $mc + $fc;
            $subto += $to;
            $x = [
                'group' => $groupName,
                'male' => [
                    'percent' => number_format(($mc / $total * 100), 1, ',', '.'),
                    'count' => $mc
                ],
                'female' => [
                    'percent' => number_format(($fc / $total * 100), 1, ',', '.'),
                    'count' => $fc
                ],
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
        $emptym = $totalm - $subtom;
        $emptyf = $totalf - $subtof;

        $items['empty'] = [
            'count' => $empty,
            'percent' => number_format(($empty / $total) * 100, 1, ',', '.'),
            'male' => [
                'count' => $emptym,
                'percent' => number_format($emptym / $total * 100, 1, ',', '.')
            ],
            'female' => [
                'count' => $emptyf,
                'percent' => number_format($emptyf / $total * 100, 1, ',', '.')
            ]
        ];
        $items['total'] = [
            'count' => $total,
            'male' => [
                'count' => $totalm,
                'percent' => number_format($totalm / $total * 100, 1, ',', '.')
            ],
            'female' => [
                'count' => $totalf,
                'percent' => number_format($totalf / $total * 100, 1, ',', '.')
            ]
        ];

        $data['items'] = $items;
        $data['indikator'] = $indicator;
        $data['dusun_id'] = isset($_GET['dusun']) ? $_GET['dusun'] : 'ALL';

        //return response()->json($items);
        $data['dusun'] = Wilayah::get();

        if ($request->ajax()) {
            return response()->json($data);
        }

        return view('statistik.penduduk', $data);
    }

    /**
     * Edit page.
     *
     * @param  Request  $request
     * @param  String   $id
     * @return Response
     */
    public function edit(Request $request, $id)
    {
        $data = Wilayah::find($id);
        return view('wilayah.edit', [
            'data' => $data,
            'page_title' => "Edit Wilayah : {$data->dusun}"
        ]);
    }

    /**
     * Store resource.
     *
     * @param  Request  $request
     * @param  String   $id
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'dusun' => 'required|max:255'
        ]);

        Wilayah::create([
            'dusun' => $request->dusun
        ]);

        if (isset($_POST['savenew'])) {
            return redirect()->back()->with('success', 'Wilayah successfully added.');
        } else {
            return redirect('wilayah');
        }
    }

    /**
     * Store resource.
     *
     * @param  Request  $request
     * @param  String   $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'dusun' => 'required|max:255'
        ]);

        Wilayah::find($id)->update([
            'dusun' => $request->dusun
        ]);

        return redirect('wilayah')->with('success', 'Wilayah successfully updated.');
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
        try {
            Wilayah::find($id)->delete();

            if ($request->ajax()) {
                return response()->json([
                    'error' => false,
                    'message' => 'Wilayah successfully deleted.'
                ]);
            }

            return redirect()->back()->with('success', 'Wilayah successfully deleted.');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'error' => false,
                    'message' => 'Wilayah failed to delete.'
                ]);
            }

            return redirect()->back()->with('error', 'Wilayah failed to delete.');
        }
    }
}
