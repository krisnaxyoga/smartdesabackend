<?php

namespace App\Http\Controllers;

use App\Suku;
use DB;
use Illuminate\Http\Request;

class SukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['page_title'] = "Suku";
        if ($request->type == 'datatable') {
            $sukus = Suku::orderBy('nama', 'ASC')
                ->get();

            return datatables()->of($sukus)
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group"><button type="button" class="btn btn-rounded btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-gear"></i> Action <span class="caret"></span></button><ul class="dropdown-menu"><li><a target="_blank" href="' . route('suku.edit', $data->id) . '">Edit</a></li><li><a data-id="' . $data->id . '" data-label="suku" data-url="/suku/' . $data->id . '" class="delete-item text-danger">Delete</a></li></ul></div>';
                })

                ->rawColumns(['action'])
                ->make(true);
        } else if ($request->type == 'json') {
            $sukus = Suku::orderBy('nama', 'ASC');

            if ($request->keyword) {
                $sukus = $sukus->where(
                    'nama',
                    'LIKE',
                    DB::raw('"%' . $request->keyword . '%"')
                );
            }

            $sukus = $sukus::get();

            return response()->json($sukus);
        } else {
            return view('suku.index', $data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = "Tambah Suku";
        return view('suku.create', $data);
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
            'nama' => 'required|max:255'
        ]);

        Suku::create([
            'nama' => $request->nama
        ]);

        if (isset($_POST['savenew'])) {
            return redirect()->back()->with('success', 'Suku successfully added.');
        } else {
            return redirect('suku');
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
        $data = Suku::find($id);
        return view('suku.edit', [
            'data' => $data,
            'page_title' => "Edit Suku : {$data->nama}"
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
        $this->validate($request, [
            'nama' => 'required|max:255'
        ]);

        Suku::find($id)->update([
            'nama' => $request->nama
        ]);

        return redirect('suku')->with('success', 'Suku successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Suku::find($id)->delete();

            if ($request->ajax()) {
                return response()->json([
                    'error' => false,
                    'message' => 'Suku successfully deleted.'
                ]);
            }

            return redirect()->back()->with('success', 'Suku successfully deleted.');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'error' => false,
                    'message' => 'Suku failed to delete.'
                ]);
            }

            return redirect()->back()->with('error', 'Suku failed to delete.');
        }
    }
}
