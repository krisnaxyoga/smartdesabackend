<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UsulanDesa;
use App\Wilayah;
use App\BidangEplanning;
use App\UsulanDusun;
use DB;
class UsulanDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->type == 'datatable') {
            $usulan = UsulanDesa::select('kegiatan_eplanning.id', 'bidang_eplanning.nama_bidang as nama_bidang', 'kegiatan_eplanning.nama_kegiatan as nama_kegiatan', 'kegiatan_eplanning.estimated_time as estimated_time', 'wilayah.dusun as dusun')
                ->join('bidang_eplanning','bidang_eplanning.id','=','kegiatan_eplanning.sub_bidang_id')
                ->join('wilayah', 'wilayah.id', '=', 'kegiatan_eplanning.wilayah_id')
                ->where('status', 'USULAN DESA')
                ->orderBy('kegiatan_eplanning.nama_kegiatan', 'ASC')
                ->get();

            return datatables()->of($usulan)
                ->addColumn('action', function ($usulan) {
                    return '<div class="btn-group">
                                <button type="button" class="btn btn-rounded btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-gear"></i> Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="' . route('usulan-desa.edit', $usulan->id) . '">Edit</a></li>
                                    <li><a data-id="' . $usulan->id . '" data-label="Usulan Desa" data-url="/e-planning/usulan-desa/' . $usulan->id . '" class="delete-item text-danger">Delete</a></li>
                                </ul>
                            </div>';
                })
                ->editColumn('nama_kegiatan', function($usulan){
                    return  '<a href="'. route('usulan-desa.show',$usulan->id) .'" class="text-primary">'. $usulan->nama_kegiatan .'</a>';
                })
                ->rawColumns(['action', 'nama_kegiatan'])
                ->make(true);
        }
        return view('e-planning.usulan-desa.index',[
            'page_title' => 'Usulan Desa'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bidang = BidangEplanning::where('parent_id','!=', NUll)->with('parent')->orderBy('nama_bidang', 'ASC')->get();
        $wilayah = Wilayah::orderBy('dusun', 'ASC')->get();
        return view('e-planning.usulan-desa.create', [
            'page_title' => 'Tambah Usulan Desa',
            'listBidang' => $bidang,
            'listWilayah' => $wilayah
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request,[
            'bidang_id' => 'required',
            'nama_kegiatan' => 'required',
            'wilayah_id' => 'required',
            'volume' => 'required',
            'manfaat' => 'required',
            'estimated_time' => 'required',
            'jumlah' => 'required'
        ]);

        try {
            $data = [
                'sub_bidang_id' => $request->bidang_id,
                'wilayah_id' => $request->wilayah_id,
                'nama_kegiatan' => $request->nama_kegiatan,
                'volume' => $request->volume,
                'manfaat' => $request->manfaat,
                'estimated_time' => $request->estimated_time,
                'jumlah' => $request->jumlah,
                'status' => 'USULAN DESA'
            ];
            // dd($data);
            UsulanDesa::create($data);
            return redirect()->route('usulan-desa.index');
        } catch (\Throwable $e) {
            // dd('Error',$e);
            return back()
                ->with('error', "Error on file {$e->getFile()} line {$e->getLine()}: {$e->getMessage()}");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $data = UsulanDesa::select()
        //     ->join('bidang_eplanning','bidang_eplanning.id','=','kegiatan_eplanning.sub_bidang_id')
        //     ->join('wilayah', 'wilayah.id', '=', 'kegiatan_eplanning.wilayah_id')
        //     ->where('kegiatan_eplanning.id', $id)
        //     ->first();
        $data = UsulanDesa::with(['bidang'=> function($bidang) {
                    $bidang->with('parent');
        },'wilayah'])->where('id',$id)->first();

        // return response()->json($data);
        // dd($data);
        return view('e-planning.usulan-desa.detail', [
            'page_title' => 'Detail Usulan Desa',
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bidang = BidangEplanning::where('parent_id','!=', NUll)->with('parent')->orderBy('nama_bidang', 'ASC')->get();
        $wilayah = Wilayah::orderBy('dusun', 'ASC')->get();

        $data = UsulanDesa::select()
            ->where('kegiatan_eplanning.id', $id)
            ->first();

            // dd($data);
            return view('e-planning.usulan-desa.edit',[
                'page_title' => 'Edit Usulan Desa',
                'data' => $data,
                'listBidang' => $bidang,
                'listWilayah' => $wilayah
            ]);
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
        // dd($request);
        $this->validate($request,[
            'bidang_id' => 'required',
            'nama_kegiatan' => 'required',
            'wilayah_id' => 'required',
            'volume' => 'required',
            'manfaat' => 'required',
            'estimated_time' => 'required',
            'jumlah' => 'required'
        ]);

        try {
            $data = [
                'sub_bidang_id' => $request->bidang_id,
                'wilayah_id' => $request->wilayah_id,
                'nama_kegiatan' => $request->nama_kegiatan,
                'volume' => $request->volume,
                'manfaat' => $request->manfaat,
                'estimated_time' => $request->estimated_time,
                'jumlah' => $request->jumlah
            ];
            // dd($data);
            UsulanDesa::find($id)->update($data);
            return redirect()->route('usulan-desa.index');
        } catch (\Throwable $e) {
            return back()
                ->with('error', "Error on file {$e->getFile()} line {$e->getLine()}: {$e->getMessage()}");
        } catch (\Throwable $e) {
            return back()
                ->with('error', "Error on file {$e->getFile()} line {$e->getLine()}: {$e->getMessage()}");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try {
            UsulanDesa::find($id)->delete();

            if ($request->ajax()) {
                return response()->json([
                    'error' => false,
                    'message' => 'Usulan Desa successfully deleted.'
                ]);
            }

            return redirect()->back()->with('success', 'Usulan Desa successfully deleted.');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'error' => false,
                    'message' => 'Usulan Desa failed to delete.'
                ]);
            }

            return redirect()->back()->with('error', 'Usulan Desa failed to delete.');
        }
    }
}
