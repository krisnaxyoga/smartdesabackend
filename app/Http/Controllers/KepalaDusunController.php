<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KepalaDusun;
use App\Wilayah;
use DB;

class KepalaDusunController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['page_title'] = "Kepala Dusun";
        $desa_id = auth()->user()->desa_id;
        if ($request->type == 'datatable') {
            $data = KepalaDusun::select('kepala_dusun.*', 'wilayah.dusun', 'wilayah.desa_id')
                ->join('wilayah', 'wilayah.id', '=', 'kepala_dusun.dusun_id')
                ->where('wilayah.desa_id', $desa_id)
                ->orderBy('name', 'ASC');

            return datatables()->of($data)
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group"><button type="button" class="btn btn-rounded btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-gear"></i> Action <span class="caret"></span></button><ul class="dropdown-menu"><li><a href="' . route('kepala-dusun.edit', $data->id) . '">Edit</a></li><li><a data-id="' . $data->id . '" data-label="Kepala Dusun" data-url="/kepala-dusun/' . $data->id . '" class="delete-item text-danger">Delete</a></li></ul></div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        } else if ($request->type == 'json') {
            $data = KepalaDusun::orderBy('name', 'ASC');

            if ($request->keyword) {
                $data = $data->where(
                    'pamong_nama',
                    'LIKE',
                    DB::raw('"%' . $request->keyword . '%"')
                );
            }

            $data = $data::get();

            return response()->json($data);
        }
        else {
            return view('kepala_dusun.index', $data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'dusun' => Wilayah::select('id', 'dusun')->get(),
            'page_title' => "Tambah Kepala Dusun"
        ];
        return view('kepala_dusun.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'dusun_id' => 'required|string',
        ]);

        try {
            KepalaDusun::create([
                'name' => $request->name,
                'dusun_id' => $request->dusun_id,
                'username' => $request->username,
                'phone' => $request->phone,
                'pin' => bcrypt($request->pin),
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors([$th->getMessage() . " at line " . $th->getLine()]);
        }



        return redirect()->route('kepala-dusun.index');
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
        $data = [
            'data' => KepalaDusun::find($id),
            'dusun' => Wilayah::select('id', 'dusun')->get(),
            'page_title' => "Edit Kepala Dusun"
        ];
        return view('kepala_dusun.edit', $data);
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
        $data = KepalaDusun::findOrFail($id);
        $this->validate($request, [
            'name' => 'required|string',
            'dusun_id' => 'required|string',
        ]);

        $update = [
            'name' => $request->get('name', $data->name),
            'dusun_id' => $request->get('dusun_id', $data->dusun_id),
            'username' => $request->get('username', $data->username),
            'phone' => $request->get('phone', $data->phone),
        ];

        if (isset($request->pin)) {
            $update['pin'] = bcrypt($request->pin);
        }

        $data->update($update);

        return redirect()->route('kepala-dusun.index');
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
        $data = KepalaDusun::find($id);

        $data->delete();

        return response()->json([
            'error' => false,
            'message' => 'success'
        ]);
    }
}
