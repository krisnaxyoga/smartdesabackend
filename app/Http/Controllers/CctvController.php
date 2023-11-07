<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cctv;

class CctvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Cctv::all();


        if ($request->type == "datatable") {
            return datatables()->of($data)
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group">
                                <button type="button" class="btn btn-rounded btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-gear"></i> Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="' . route('cctv.edit', $data->id) . '">Edit</a></li>
                                    <li><a data-id="' . $data->id . '" data-label="CCTV" data-url="/cctv/' . $data->id . '" class="delete-item text-danger">Delete</a></li>
                                </ul>
                            </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view("cctv.index",[
            'page_title' => "CCTV"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cctv.create', [
            'page_title' => 'Buat CCTV'
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
        $this->validate($request,[
            'nama_cctv' => 'required',
            'lat' => 'required',
            'lng' => 'required'
        ]);

        $data = [
            'nama_cctv' => $request->nama_cctv,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'link' => $request->link,
            'keterangan' => $request->description
        ];

        try {
            Cctv::create($data);
            return redirect()->route('cctv.index');

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
        $data = Cctv::find($id);

        return view('cctv.edit', [
            'page_title' => 'Edit CCTV',
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
        $this->validate($request,[
            'nama_cctv' => 'required',
            'lat' => 'required',
            'lng' => 'required'
        ]);

        $data = [
            'nama_cctv' => $request->nama_cctv,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'link' => $request->link,
            'keterangan' => $request->description
        ];
        try {
            Cctv::find($id)->update($data);
            return redirect()->route('cctv.index');

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
            Cctv::find($id)->delete();

            if ($request->ajax()) {
                return response()->json([
                    'error' => false,
                    'message' => 'CCTV successfully deleted.'
                ]);
            }

            return redirect()->back()->with('success', 'CCTV successfully deleted.');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'error' => false,
                    'message' => 'CCTV failed to delete.'
                ]);
            }

            return redirect()->back()->with('error', 'CCTV failed to delete.');
        }
    }
}
