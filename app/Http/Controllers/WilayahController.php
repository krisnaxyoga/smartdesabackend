<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Auth, DB;

use App\Wilayah;

class WilayahController extends Controller
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
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        $data['page_title'] = "Wilayah";
        if ($request->type == 'datatable') {
            $wilayahs = Wilayah::orderBy('dusun', 'ASC')
                ->get();

            return datatables()->of($wilayahs)
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group"><button type="button" class="btn btn-rounded btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-gear"></i> Action <span class="caret"></span></button><ul class="dropdown-menu"><li><a href="' . route('wilayah.edit', $data->id) . '">Edit</a></li><li><a data-id="' . $data->id . '" data-label="wilayah" data-url="/wilayah/' . $data->id . '" class="delete-item text-danger">Delete</a></li></ul></div>';
                })
                
                ->rawColumns(['action'])
                ->make(true);
        } else if ($request->type == 'json') {
            $wilayahs = Wilayah::orderBy('dusun', 'ASC');
            
            if ($request->keyword) {
                $wilayahs = $wilayahs->where(
                    'dusun', 
                    'LIKE', 
                    DB::raw('"%' . $request->keyword . '%"')
                );
            }

            $wilayahs = $wilayahs::get();

            return response()->json($wilayahs);
        } else {
            return view('wilayah.index', $data);
        }
    }

    /**
     * Create page.
     * 
     * @param  Request  $request
     * @return Response
     */
    public function create(Request $request)
    {
        $data['page_title'] = "Tambah Wilayah";
        return view('wilayah.create', $data);
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
            'dusun' => $request->dusun,
            'coordinate' => $request->coordinates,
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
            'dusun' => $request->dusun,
            'coordinate' => $request->coordinates,
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
