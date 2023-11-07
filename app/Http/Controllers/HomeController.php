<?php

namespace App\Http\Controllers;

use App\Booking;

use App\Keluarga;
use App\Penduduk;
use App\PendudukPendatang;
use App\PendudukAgama;
use App\PendudukKawin;
use App\PendudukWarganegara;
use App\PengajuanSurat;
use App\Program;
use App\Wilayah;
use App\Desa;
use Auth;
use DB;
use Illuminate\Http\Request;

class HomeController extends Controller
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
     * @return Response $response
     */
    public function index()
    {
        $data['page_title'] = 'Dashboard';
        $data['jml_surat'] = PengajuanSurat::selectRaw('COUNT(pengajuan_surat.id) AS count')
            ->orderBy('pengajuan_surat.created_at', 'DESC')
            ->join('penduduk', 'penduduk.id', '=', 'pengajuan_surat.penduduk_id')
            ->join('wilayah', 'wilayah.id', '=', 'pengajuan_surat.dusun_id')
            ->join('jenis_surat', 'jenis_surat.id', '=', 'pengajuan_surat.jenis_surat_id')
            ->where('pengajuan_surat.status', '=', 'GENERATED')
            ->first()->count;

        $data['jml_penduduk'] = Penduduk::selectRaw('COUNT(id) AS count')->first()->count;
        $data['jml_duktang'] = PendudukPendatang::selectRaw('COUNT(id) AS count')->first()->count;
        $data['jml_keluarga'] = Keluarga::selectRaw('COUNT(id) AS count')
            ->orderBy('id', 'ASC')
            // ->whereHas('kepalaKeluarga')
            // ->whereHas('dusun')
            // ->with([
            //     'kepalaKeluarga',
            //     'dusun'
            // ])
            ->first()
            ->count;
        $data['jml_program'] = Program::selectRaw('COUNT(id) AS count')->first()->count;
        $data['jml_wilayah'] = Wilayah::selectRaw('COUNT(id) AS count')->first()->count;


        $labelOther = "LAINNYA / BELUM MENGISI";

        /* START - CHART PEKERJAAN */

        $listPekerjaan = Penduduk::select('penduduk_pekerjaan.id', 'penduduk_pekerjaan.nama', DB::raw('COUNT(penduduk.id) as total'))
            ->join('penduduk_pekerjaan', 'penduduk_pekerjaan.id', '=', 'penduduk.pekerjaan_id')
            ->where('status_dasar', 1)->groupBy('pekerjaan_id')
            ->orderBy('total', 'desc')->limit(5)->get();


        $chartPekerjaan = [];
        $selectedPekerjaan = [];

        foreach ($listPekerjaan as $x) {
            $selectedPekerjaan[] = $x->id;
            $chartPekerjaan['labels'][] = $x->nama;
            $chartPekerjaan['values'][] = $x->total;
        }

        if (count($selectedPekerjaan) > 0) {

            $otherPekerjaan = Penduduk::where('status_dasar', 1)
                ->whereNotIn('pekerjaan_id', $selectedPekerjaan)
                ->orderBy('total', 'desc')->count();

            if ($otherPekerjaan > 0) {
                $chartPekerjaan['labels'][] = $labelOther;
                $chartPekerjaan['values'][] = $otherPekerjaan;
            }
        } else {
            $otherPekerjaan = Penduduk::where('status_dasar', 1)
                ->whereNull('pekerjaan_id')
                ->orderBy('total', 'desc')->count();

            if ($otherPekerjaan > 0) {
                $chartPekerjaan['labels'][] = $labelOther;
                $chartPekerjaan['values'][] = $otherPekerjaan;
            }
        }

        /* END - CHART PEKERJAAN */

        $listDusun = Wilayah::orderBy('dusun', 'ASC')->get();

        $chartPendudukDusun = [];

        foreach ($listDusun as $x) {
            $chartPendudukDusun['labels'][] = $x->dusun;
            $chartPendudukDusun['values'][] = Penduduk::where('status_dasar', 1)->where('dusun_id', $x->id)->count();
        }

        $chartRasioJkDusun = [];

        foreach ($listDusun as $x) {
            $chartRasioJkDusun['labels'][] = $x->dusun;
            $chartRasioJkDusun['values_laki'][] = Penduduk::where('status_dasar', 1)->where('sex', 1)->where('dusun_id', $x->id)->count();
            $chartRasioJkDusun['values_perempuan'][] = Penduduk::where('status_dasar', 1)->where('sex', 2)->where('dusun_id', $x->id)->count();
        }


        $chartKawin = [];
        $listKawin = PendudukKawin::get();

        foreach ($listKawin as $x) {
            $chartKawin['labels'][] = $x->nama;
            $chartKawin['values'][] = Penduduk::where('status_dasar', 1)->where('status_kawin_id', $x->id)->count();
        }

        $chartAgama = [];
        $listAgama = PendudukAgama::orderBy('nama', 'ASC')->get();

        foreach ($listAgama as $x) {
            $in = $x->nama;
            $out = strlen($in) > 30 ? substr($in, 0, 30) . "..." : $in;

            $chartAgama['labels'][] = $out;
            $chartAgama['values'][] = Penduduk::where('status_dasar', 1)->where('agama_id', $x->id)->count();
        }

        $chartWarganegara = [];
        $listWarganegara = PendudukWarganegara::get();

        foreach ($listWarganegara as $x) {

            $chartWarganegara['labels'][] = $x->nama;
            $chartWarganegara['values'][] = Penduduk::where('status_dasar', 1)->where('warganegara_id', $x->id)->count();
        }

        $data['chart_pekerjaan'] = $chartPekerjaan;
        $data['chart_dusun'] = $chartPendudukDusun;
        $data['chart_rasio_dusun'] = $chartRasioJkDusun;
        $data['chart_kawin'] = $chartKawin;
        $data['chart_agama'] = $chartAgama;
        $data['chart_warganegara'] = $chartWarganegara;

        return view('home', $data);
    }


    public function revenue()
    {
        $data = [];
        $dateLast = $_GET['year'] . '-' . $_GET['month'] . '-01';
        $lastday = date('t', strtotime($dateLast));
        for ($i = 1; $i <= $lastday; $i++) {
            $date = $_GET['year'] . '-' . $_GET['month'] . '-' . sprintf("%08d", $i);
            $data['labels'][] = $i;
            $data['values'][] = BookingDetail::where("item_date", $date)->whereHas('booking', function ($booking) {
                $booking->where('merchant_id', Auth::user()->merchant_id)->where('status', 'ON PROCESS');
            })->sum('total');
        }
        return response()->json($data);
    }

    public function country()
    {
        $data = [];
        $dateLast = $_GET['year'] . '-' . $_GET['month'] . '-01';

        $lists = Booking::select('countries.name', DB::raw('COUNT(passengers.id) as num'))
            ->join('booking_details', 'booking_details.booking_id', '=', 'bookings.id')
            ->join('passengers', 'passengers.booking_id', '=', 'bookings.id')
            ->join('countries', 'passengers.country_id', '=', 'countries.id')
            ->where('bookings.status', 'ON PROCESS')
            ->where(DB::raw('MONTH(booking_details.item_date)'), $_GET['month'])
            ->where(DB::raw('YEAR(booking_details.item_date)'), $_GET['year'])
            ->groupBy('passengers.country_id')
            ->orderBy('num', 'DESC')->get();

        $limit = isset($_GET['limit']) ? $_GET['limit'] : 3;
        $idx = 1;
        foreach ($lists as $list) {
            if ($idx < $limit + 1) {
                $data['labels'][] = $list->name;
                $data['values'][] = $list->num;
            } else {
                if ($idx == $limit + 1) {
                    $data['labels'][] = 'Other';
                    $data['values'][] = $list->num;
                } else {
                    $data['values'][$limit - 1] += $list->num;
                }
            }
            $idx++;
        }

        if (count($lists) == 0) {
            $data = ['labels' => [], 'values' => []];
        }
        return response()->json($data);
    }

    public function customer()
    {
        $data = [];
        $limit = isset($_GET['limit']) ? $_GET['limit'] : 5;

        $lists = Booking::select('contact_name', DB::raw('SUM(booking_details.total) as num'))
            ->join('booking_details', 'booking_details.booking_id', '=', 'bookings.id')
            ->where('bookings.status', 'ON PROCESS')
            ->where(DB::raw('MONTH(booking_details.item_date)'), $_GET['month'])
            ->where(DB::raw('YEAR(booking_details.item_date)'), $_GET['year'])
            ->groupBy('bookings.contact_email')
            ->orderBy('num', 'DESC')
            ->limit($limit)
            ->get();


        foreach ($lists as $list) {
            $data['labels'][] = $list->contact_name;
            $data['values'][] = $list->num;
        }
        if (count($lists) == 0) {
            $data = ['labels' => [], 'values' => []];
        }

        return response()->json($data);
    }

    public function product()
    {
        $data = [];
        $limit = isset($_GET['limit']) ? $_GET['limit'] : 5;

        $lists = Booking::select(
            DB::raw('origin.port_code AS origin_code'),
            DB::raw('destination.port_code AS destination_code'),
            'schedules.departure',
            DB::raw('SUM(booking_details.qty) as num')
        )
            ->join('booking_details', 'booking_details.booking_id', '=', 'bookings.id')
            ->join('schedules', 'booking_details.product_id', '=', 'schedules.id')
            ->join(DB::raw('ports as origin'), 'schedules.origin_id', '=', 'origin.id')
            ->join(DB::raw('ports as destination'), 'schedules.destination_id', '=', 'destination.id')
            ->where('bookings.status', 'ON PROCESS')
            ->where(DB::raw('MONTH(booking_details.item_date)'), $_GET['month'])
            ->where(DB::raw('YEAR(booking_details.item_date)'), $_GET['year'])
            ->where('booking_details.product_type', 'BOAT')
            ->groupBy('booking_details.product_id')
            ->orderBy('num', 'DESC')
            ->limit($limit)
            ->get();


        foreach ($lists as $list) {
            $data['labels'][] = $list->origin_code . " - " . $list->destination_code . " " . date('H:m', strtotime($list->departure));
            $data['values'][] = $list->num;
        }
        if (count($lists) == 0) {
            $data = ['labels' => [], 'values' => []];
        }
        return response()->json($data);
    }
}
