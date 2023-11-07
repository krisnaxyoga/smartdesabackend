<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\BidangEplanning;
class BidangEplanningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->type == "datatable") {
            $bidang = BidangEplanning::get();
            return datatables()->of($bidang)
                ->addColumn('action', function ($bidang) {
                    return '<center>
                                <a href="' . route('bidang.edit', [$bidang->id]) . '" class="btn btn-warning btn-sm text-center" style="display : inline-block"><i class="fa fa-pencil"></i></a>
                                <a data-id = "'. $bidang->id .'" data-label="Bidang" data-url="'  . route('bidang.destroy', [$bidang->id]) .  '" class="btn btn-danger btn-sm text-center text-white delete-item" style="display : inline-block"><i class="fa fa-trash"></i></a>
                            </center>';
                })
                ->addColumn('induk', function ($bidang) {
                    if (!empty($bidang->parent_id)) {
                        $data = BidangEplanning::select("nama_bidang")->where("id", $bidang->parent_id)->get();
                        foreach ($data as $key => $value) {
                            return $value->nama_bidang;
                        }
                    }else{
                        return "-";
                    }
                })
                ->rawColumns(['action', 'nama_bidang', 'induk'])
                ->make(true);
        }
        return view("bidang.index",[
            'page_title' => "Bidang"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataBidang = BidangEplanning::select("id", "parent_id", "nama_bidang")->where("parent_id", null)->get();

        return view("bidang.create", [
            'page_title' => "Tambah Bidang",
            'listBidang' => $dataBidang
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
        if($request->jenis_bidang == 2){
            $this->validate($request, [
                'nama_bidang' => 'required',
                'kode_bidang' => 'required',
            ]);
            $data = ['nama_bidang' => $request->nama_bidang,
                     'kode_bidang' => $request->kode_bidang ];
        }elseif ($request->jenis_bidang == 1) {
            $this->validate($request, [
                'nama_sub_bidang' => 'required',
                'nama_induk_bidang' => 'required'
            ]);
            $data = ['nama_bidang' => $request->nama_sub_bidang, 'parent_id' => $request->nama_induk_bidang];
        }

        try {
            BidangEplanning::create($data);
            return redirect()->route('bidang.index');
        } catch (\Throwable $e) {
            return back()
                ->with('error', "Error on file {$e->getFile()} line {$e->getLine()}: {$e->getMessage()}");
        } catch (\Throwable $e) {
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataBidang = BidangEplanning::select("id", "parent_id", "nama_bidang")->where("parent_id", null)->get();
        $data = BidangEplanning::select("id", "parent_id", "nama_bidang","kode_bidang")->where("id", $id)->first();
        return view('bidang.edit',[
            'page_title' => "Edit Bidang",
            'listBidang' => $dataBidang,
            'data' => $data
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
        $data = [
            'kode_bidang' => $request->kode_bidang,
            'nama_bidang' => $request->nama_bidang,
            'parent_id' => $request->nama_induk_bidang
        ];
        try {
            BidangEplanning::find($id)->update($data);
            return redirect()->route('bidang.index');
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
            BidangEplanning::find($id)->delete();

            if ($request->ajax()) {
                return response()->json([
                    'error' => false,
                    'message' => 'Bidang successfully deleted.'
                ]);
            }

            return redirect()->back()->with('success', 'Bidang successfully deleted.');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'error' => false,
                    'message' => 'Bidang failed to delete.'
                ]);
            }

            return redirect()->back()->with('error', 'Bidang failed to delete.');
        }
    }
}
