<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Auth, DB;

use App\Area;

class AgentController extends Controller
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
        if ($request->type == 'datatable') {
            $areas = Area::where('merchant_id', '=', Auth::user()->merchant_id)
                ->orderBy('name', 'ASC')
                ->get();

            return datatables()->of($areas)
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group"><button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <span class="caret"></span></button><ul class="dropdown-menu"><li><a href="' . route('area.edit', $data->id) . '">Edit</a></li><li><a data-id="' . $data->id . '" data-label="Area" data-url="/area/' . $data->id . '" class="delete-item text-danger">Delete</a></li></ul></div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        } else if ($request->type == 'json') {
            $areas = Area::where('merchant_id', Auth::user()->merchant_id);
            
            if ($request->keyword) {
                $areas = $areas->where(
                    'name', 
                    'LIKE', 
                    DB::raw('"%' . $request->keyword . '%"')
                );
            }

            $areas = $areas->orderBy('name', 'ASC')->get();

            return response()->json($areas);
        } else {
            return view('area.index');
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
        return view('area.create');
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
        $data = Area::find($id);
        return view('area.edit')->with('data', $data);
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
            'name' => 'required|max:255'
        ]);

        Area::create([
            'name' => $request->name,
            'merchant_id' => Auth::user()->merchant_id
        ]);

        if (isset($_POST['savenew'])) {
            return redirect()->back()->with('success', 'Area successfully added.');
        } else {
            return redirect('area');
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
            'name' => 'required|max:255'
        ]);

        Area::find($id)->update([
            'name' => $request->name
        ]);

        return redirect('area')->with('success', 'Area successfully updated.');
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
            Area::find($id)->delete();

            if ($request->ajax()) {
                return response()->json([
                    'error' => false,
                    'message' => 'Area successfully deleted.'
                ]);
            }

            return redirect()->back()->with('success', 'Area successfully deleted.');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'error' => false,
                    'message' => 'Area failed to delete.'
                ]);
            }

            return redirect()->back()->with('error', 'Area failed to delete.');
        }
    }
}
