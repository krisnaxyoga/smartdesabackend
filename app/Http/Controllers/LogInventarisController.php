<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\LogInventaris;

class LogInventarisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id, $id_detail)
    {
        $data = LogInventaris::where('detail_inventaris_id', $id_detail)->get();
        if ($request->type == "datatable") {
            return datatables()->of($data)
            ->editColumn('kondisi_lama', function ($data){
                if ($data->kondisi_lama == "B") {
                    return "Baik";
                }elseif($data->kondisi_lama == "KB"){
                    return "Kurang Baik";
                }elseif($data->kondisi_lama == "RB"){
                    return "Sangat Kurang Baik";
                }else{
                    return "-";
                }
            })
            ->editColumn('kondisi_baru', function ($data){
                if ($data->kondisi_baru == "B") {
                    return "Baik";
                }elseif($data->kondisi_baru == "KB"){
                    return "Kurang Baik";
                }elseif($data->kondisi_baru == "RB"){
                    return "Rusak Berat";
                }else{
                    return "-";
                }
            })
            ->make(true);

        }

        return response()->json($data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
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
}
